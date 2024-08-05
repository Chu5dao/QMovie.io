<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Movie;
use App\Models\Episode;
use App\Models\ServerMovie;
use App\Models\Category;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_movies = Movie::orderBy('id', 'DESC')->get(['id', 'title', 'resolution']); // pluck chỉ lấy ra một cặp giá trị (key và value) nên ta dùng get()
        $list_episode = Episode::with('movie')->orderBy('movie_id', 'DESC')->get();
        $server = ServerMovie::orderBy('id', 'DESC')->pluck('title', 'id');
        $server_list = ServerMovie::orderBy('id', 'DESC')->get();

        $list_movie_with_resolution = [];
        foreach ($list_movies as $movie) {
            $list_movie_with_resolution[$movie->id] = $movie->title . ' (' . $this->getResolutionText($movie->resolution) . ')';
        }
        return view('admin.episode.index', compact('list_movie_with_resolution', 'list_episode', 'server', 'server_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_movies = Movie::orderBy('id', 'DESC')->get(['id', 'title', 'resolution']);
        $list_episode = Episode::with('movie')->orderBy('movie_id', 'DESC')->get();
        $server = ServerMovie::orderBy('id', 'DESC')->pluck('title', 'id');

        $list_movie_with_resolution = [];
        foreach ($list_movies as $movie) {
            $list_movie_with_resolution[$movie->id] = $movie->title . ' (' . $this->getResolutionText($movie->resolution) . ')';
        }
        // return response()->json($list_episode);
        return view('admin.episode.form', compact('list_movie_with_resolution', 'list_episode', 'server'));
    }

    // clean code
    // public function index()
    // {
    //     $data = $this->getMoviesAndEpisodes();
    //     return view('admin.episode.form', $data);
    // }

    // public function create()
    // {
    //     $data = $this->getMoviesAndEpisodes();
    //     return view('admin.episode.form', $data);
    // }

    // private function getMoviesAndEpisodes()
    // {
    //     $list_movies = Movie::orderBy('id', 'DESC')->get(['id', 'title', 'resolution']);
    //     $list_episode = Episode::with('movie')->orderBy('movie_id', 'DESC')->get();
        
    //     $movies_with_resolution = [];
    //     foreach ($list_movies as $movie) {
    //         $movies_with_resolution[$movie->id] = $movie->title . ' (' . $this->getResolutionText($movie->resolution) . ')';
    //     }

    //     return [
    //         'list_movie_with_resolution' => $movies_with_resolution,
    //         'list_episode' => $list_episode
    //     ];
    // }

    private function getResolutionText($resolution)
    {
        switch ($resolution) {
            case 0:
                return 'HD';
            case 1:
                return 'SD';
            case 2:
                return 'HD-CAM';
            case 3:
                return 'Cam';
            case 4:
                return 'FULL-HD';
            case 5:
                return 'Trailer';
            default:
                return 'Unknown';
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'movie_id' => 'required|integer',
            'link' => 'required|string|max:255',
            'episode' => 'integer',
            'new_episode' => 'nullable|integer',
        ], [
            'movie_id.required' => 'Không tìm thấy Phim nào được chọn.',
            'link.required' => 'Không tìm thấy Link của Phim.',
            'episode.integer' => 'Không tìm thấy Tập Phim.',
            'new_episode.integer' => 'Tập Phim mới phải là số nguyên.',
        ]);
         // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()], 422);
        // }

        $data = $request->all();
        $movie = Movie::find($request->input('movie_id'));
        // Determine the episode number
        $episodeNumber = $request->filled('new_episode') ? $request->input('new_episode') : $request->input('episode');
        // Check if the episode already exists for the movie and server
        $existingEpisode = Episode::where('movie_id', $request->input('movie_id'))
        ->where('episode', $episodeNumber)
        ->where('server', $request->input('server'))
        ->first();
        if ($existingEpisode) {
            return redirect()->back()->withErrors(['episode' => 'Tập Phim đã tồn tại. Vui lòng đến trang cập nhật tập phim!']);
        }
        // Update ep_number in Movie if new_episode is greater
        if ($request->filled('new_episode') && $request->input('new_episode') > $movie->ep_number) {
            $movie->ep_number = $request->input('new_episode');
            $movie->save();
        } elseif (!$request->filled('episode')) {
            // If both new_episode and episode are not filled, add an error
            return redirect()->back()->withErrors(['episode' => 'Tập Phim không được để trống'])->withInput();
            // return response()->json(['errors' => ['episode' => 'Tập Phim không được để trống']], 422);
        }
        $ep = new Episode();
        $ep->fill($data);
        $ep->episode = $episodeNumber;
        $ep->date_cr = Carbon::now('Asia/Ho_Chi_Minh');
        $ep->date_up = Carbon::now('Asia/Ho_Chi_Minh');

        $ep->save();
        return redirect()->back()->with('status', 'Thêm thành công!');
        // return response()->json(['message' => 'Thêm thành công!', 'episode' => $ep], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Episode::find($id);
        if (!$movie) {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $list_movies = Movie::orderBy('id', 'DESC')->get(['id', 'title', 'resolution']);
        $list_episode = Episode::with('movie')->orderBy('movie_id', 'DESC')->get();
        $server = ServerMovie::orderBy('id', 'DESC')->pluck('title', 'id');
        
        $movies_with_resolution = [];
        foreach ($list_movies as $movie) {
            $movies_with_resolution[$movie->id] = $movie->title . ' (' . $this->getResolutionText($movie->resolution) . ')';
        }
        $episode = Episode::find($id);
        // return response()->json($list_episode);
        return view('admin.episode.form', compact('list_movies', 'movies_with_resolution', 'episode', 'list_episode', 'server'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'movie_id' => 'required|integer',
            'link' => 'required|string|max:255',
            'episode' => 'required|integer'
        ], [
            'movie_id.required' => 'Không tìm thấy Phim nào được chọn.',
            'link.required' => 'Không tìm thấy Link của Phim.',
            'episode.required' => 'Tập Phim không được để trống',
            'episode.integer' => 'Không tìm thấy Tập Phim.',
        ]);
         // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $request->all();
        $ep = Episode::find($id);
        $ep->fill($data);
        $ep->date_up = Carbon::now('Asia/Ho_Chi_Minh');

        $ep->save();
        return redirect()->to('episode')->with('status', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Tìm tập phim theo id
        $episode = Episode::find($id);
        if (!$episode) {
            return redirect()->back()->withErrors('Tập phim không tồn tại.');
        }
        // Lấy thông tin phim liên quan
        $movie = $episode->movie;
        // Xóa tập phim
        $episode->delete();
        // Cập nhật số lượng tập phim (ep_number) trong bảng Movie
        // Kiểm tra nếu tập phim bị xóa là tập cuối cùng
        $latestEpisode = Episode::where('movie_id', $movie->id)->orderBy('episode', 'desc')->first();
        if ($latestEpisode) {
            // Cập nhật ep_number bằng tập phim lớn nhất còn lại
            $movie->ep_number = $latestEpisode->episode;
        } else {
            // Nếu không còn tập phim nào, đặt ep_number về 0
            $movie->ep_number = 0;
        }
        $movie->save();
        return redirect()->back()->with('status', 'Xóa thành công!');
    }

    public function selectMovie(Request $request) // check echo ở Network
    {
        $id = $request->query('id'); // Lấy id từ query string
        $movie_by_id = Movie::find($id);
        if (!$movie_by_id) {
            return response()->json(['error' => 'Movie not found'], 404);
        }
        // Kiểm tra nếu ep_number là 0 trước khi vào switch
        $output = '<option value=""> --- Chọn tập phim --- </option>';
        if ($movie_by_id->ep_number == 0) {
            $output .= '<option value="'. 1 .'"> Tập Lẻ </option>'; // Bổ sung thêm 1 tập nếu ep_number là 0
        } else {
            for ($i = 1; $i <= $movie_by_id->ep_number; $i++) {
                $output .= '<option value="' . $i . '">Tập ' . $i . '</option>';
            }
        }
        return response($output); // Trả về response

    }

    public function addEpisode($id){
        $server = ServerMovie::orderBy('id', 'DESC')->pluck('title', 'id');
        $server_list = ServerMovie::orderBy('id', 'DESC')->get();
        // Tìm phim với ID
        $movie = Movie::find($id);
        if (!$movie) {
            return redirect()->back()->withErrors('Không tìm thấy phim.');
        }
        // Lấy danh sách các tập phim của phim
        $list_episode = Episode::with('movie')->where('movie_id', $id)->orderBy('episode', 'DESC')->get();

        $movies_with_resolution = [
            $movie->id => $movie->title . ' (' . $this->getResolutionText($movie->resolution) . ')'
        ];
        // return response()->json($movies_with_resolution);
        return view('admin.episode.list-episode-one-film', compact('list_episode', 'movie', 'movies_with_resolution', 'server', 'server_list'));
    }

    public function storeEpisode(Request $request) {
        $validator = Validator::make($request->all(), [
            'movie_id' => 'required|integer',
            'link' => 'required|string|max:255',
            'episode' => 'nullable|integer',
            'new_episode' => 'nullable|integer',
        ], [
            'movie_id.required' => 'Không tìm thấy Phim nào được chọn.',
            'link.required' => 'Không tìm thấy Link của Phim.',
            'episode.integer' => 'Không tìm thấy Tập Phim.',
            'new_episode.integer' => 'Tập Phim mới phải là số nguyên.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $data = $request->all();
        $movie = Movie::find($request->input('movie_id'));
        
        if (!$movie) {
            return redirect()->back()->withErrors('Không tìm thấy phim.');
        }
    
        $episodeNumber = $request->input('new_episode') ?? $request->input('episode');
        
        if (!$episodeNumber) {
            return redirect()->back()->withErrors(['episode' => 'Tập Phim không được để trống'])->withInput();
        }
    
        $existingEpisode = Episode::where('movie_id', $request->input('movie_id'))
        ->where('episode', $episodeNumber)
        ->where('server', $request->input('server'))
        ->first();
        if ($existingEpisode) {
            return redirect()->back()->withErrors(['episode' => 'Tập Phim đã tồn tại. Vui lòng đến trang cập nhật tập phim!']);
        }
    
        if ($request->input('new_episode') && $request->input('new_episode') > $movie->ep_number) {
            $movie->ep_number = $request->input('new_episode');
            $movie->save();
        }
    
        $episode = new Episode();
        $episode->movie_id = $data['movie_id'];
        $episode->link = $data['link'];
        $episode->server = $data['server'];
        $episode->episode = $episodeNumber;
        $episode->date_cr = Carbon::now('Asia/Ho_Chi_Minh');
        $episode->date_up = Carbon::now('Asia/Ho_Chi_Minh');
        $episode->save();
    
        return redirect()->back()->with('status', 'Thêm thành công!');
    }
    

}
