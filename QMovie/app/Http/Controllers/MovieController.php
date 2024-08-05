<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Movie;
use App\Models\Rating;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Movie::with('category','genres','country')->withCount('episodes')->orderBy('id', 'DESC')->get(); //'category','genre','country' được thêm ở Model Movie
        $category = Category::pluck('title', 'id');
        $country = Country::pluck('title', 'id');
        $path = public_path()."/json/";
        if (!is_dir($path)){
            mkdir($path, 0777, true);
        }
        File::put($path.'movies.json', json_encode($list, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        return view('admin.watching.index', compact('list', 'category', 'country'));
    }

    public function list()
    {
        $list = Movie::with('category','genres','country')->withCount('episodes')->orderBy('id', 'DESC')->get(); //'category','genre','country' là function ở Model Movie
        $category = Category::pluck('title', 'id');
        $country = Country::pluck('title', 'id');
        $path = public_path()."/json/";
        if (!is_dir($path)){
            mkdir($path, 0777, true);
        }
        File::put($path.'movies.json', json_encode($list, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        return view('admin.watching.index', compact('list', 'category', 'country'));
    }

    /**
     * Show the form for creating a new resource.s
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $category = Category::pluck('title', 'id');
        $genre = Genre::pluck('title', 'id');
        $list_genre = Genre::all();
        $country = Country::pluck('title', 'id');
        // $list = Movie::with('category','genre','country')->orderBy('id', 'DESC')->get(); //'category','genre','country' là function ở Model Movie
        return view('admin.watching.form', compact(
            // 'list', 
            'category', 'genre', 'country', 'list_genre'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Kiểm tra độ dài ký tự trường
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'slug' => 'required|max:255',
            'description' => 'required|max:100000',
            'duration' => 'nullable|max:100',
            'ep_number' => 'nullable|integer',
            // 'image' => 'required|max:255',
        ], [
            'title.required' => 'Trường Tên Phim là bắt buộc.',
            'title.max' => 'Tên Phim không được dài hơn :max ký tự.',
            'slug.required' => 'Trường Slug là bắt buộc.',
            'slug.max' => 'Slug không được dài hơn :max ký tự.',
            'description.required' => 'Trường Mô Tả là bắt buộc.',
            'description.max' => 'Mô Tả không được dài hơn :max ký tự.',
            'duration.max' => 'Thời Lượng không được dài hơn :max ký tự.',
            'ep_number.integer' => 'Trường Số Tập phải là số nguyên.',
            // 'image.required' => 'Trường Hình Ảnh là bắt buộc.',
            // 'image.max' => 'Ký tự tên Hình Ảnh không được dài hơn :max ký tự.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Tiếp tục xử lý lưu dữ liệu khi validation thành công
        $data = $request->all();
        // dd($data);
        $movie = new Movie();
        $movie->fill($data);
        // $movie->title = $data['title'];
        // $movie->name_eng = $data['name_eng'];
        // $movie->description = $data['description'];
        // $movie->tags = $data['tags'];
        // $movie->duration = $data['duration'];
        // $movie->hot = $data['hot'];
        // $movie->resolution = $data['resolution'];
        // $movie->trailer = $data['trailer'];
        // $movie->subtitled = $data['subtitled'];
        // $movie->status = $data['status'];
        // $movie->category_id = $data['category_id'];
        // $movie->country_id = $data['country_id'];
        // $movie->slug = $data['slug'];
        $movie->year = $request->input('year');
        // Thêm thể loại đầu tiên vào genre_id
        if (isset($data['genre']) && is_array($data['genre']) && count($data['genre']) > 0) {
            $movie->genre_id = $data['genre'][0];
        }else{
            return redirect()->back()->withErrors('Thể loại chưa được chọn');
        }
        // $movie->views = rand(100, 99999);
        $movie->date_cr = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->date_up = Carbon::now('Asia/Ho_Chi_Minh');
        // foreach($data['genre'] as $key => $gen){
        //     $movie->genre_id = $gen[0];
        // }
        // $movie->genre_id = $data['genre_id'];

        // thêm hình ảnh
        $get_image = $request->file('image');
        $path = 'uploads/movie';
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $movie->image = $new_image;

            $movie->save();
            // Lưu genres vào bảng trung gian
            if (isset($data['genre'])) {
                $movie->genres()->attach($data['genre']);
            }
            return redirect()->back()->with('status', 'Thêm thành công!');
        }else{
            return redirect()->back()->withErrors('Lỗi khi thêm ảnh');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Movie::find($id);
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
        $category = Category::pluck('title', 'id');
        $genre = Genre::pluck('title', 'id');
        $country = Country::pluck('title', 'id');
        $list_genre = Genre::all();

        $movie = Movie::with('genres')->find($id);
        // Chuyển đổi genre_id thành mảng nếu nó không phải là mảng
        if ($movie && !is_array($movie->genre_id)) {
            $movie->genre_id = json_decode($movie->genre_id, true);
        }
        return view('admin.watching.form', compact(
            'category', 'genre', 'country', 'movie', 'list_genre'
        ));
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
        // Kiểm tra độ dài ký tự trường
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'slug' => 'required|max:255',
            'description' => 'required|max:100000',
            'duration' => 'nullable|max:100',
            'ep_number' => 'nullable|integer',
            // 'image' => 'required|max:255',
        ], [
            'title.required' => 'Trường Tên Phim là bắt buộc.',
            'title.max' => 'Tên Phim không được dài hơn :max ký tự.',
            'slug.required' => 'Trường Slug là bắt buộc.',
            'slug.max' => 'Slug không được dài hơn :max ký tự.',
            'description.required' => 'Trường Mô Tả là bắt buộc.',
            'description.max' => 'Mô Tả không được dài hơn :max ký tự.',
            'duration.max' => 'Thời Lượng không được dài hơn :max ký tự.',
            'ep_number.integer' => 'Trường Số Tập phải là số nguyên.',
            // 'image.required' => 'Trường Hình Ảnh là bắt buộc.',
            // 'image.max' => 'Ký tự tên Hình Ảnh không được dài hơn :max ký tự.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Tiếp tục xử lý lưu dữ liệu khi validation thành công
        // Lấy đối tượng Movie theo ID hoặc ném ngoại lệ nếu không tồn tại
        $movie = Movie::findOrFail($id);
        // Lấy tất cả dữ liệu từ request
        $data = $request->all();
        // dd($data);
        // Gán giá trị cho các thuộc tính của đối tượng Movie
        $movie->title = $data['title'];
        $movie->name_eng = $data['name_eng'];
        $movie->description = $data['description'];
        $movie->tags = $data['tags'];
        $movie->duration = $data['duration'];
        $movie->hot = $data['hot'];
        $movie->resolution = $data['resolution'];
        $movie->trailer = $data['trailer'];
        $movie->subtitled = $data['subtitled'];
        $movie->status = $data['status'];
        $movie->category_id = $data['category_id'];
        // $movie->genre_id = $data['genre_id'];
        $movie->country_id = $data['country_id'];
        $movie->slug = $data['slug'];

        // Xử lý hình ảnh
        $get_image = $request->file('image');
        if ($get_image) {
            $path = 'uploads/movie';
            // $path = public_path('uploads/movie');
            // Nếu có hình ảnh cũ, kiểm tra xem nó có tồn tại không và xóa nó
            // if (!empty($movie->image) && file_exists($path . '/' . $movie->image)) {
            //     unlink($path . '/' . $movie->image);
            // }
            // Xóa hình ảnh cũ nếu có

            if (!empty($movie->image) && file_exists($path . '/' . $movie->image)) {
                unlink($path . '/' . $movie->image);
                
                // Lấy tên file gốc và tạo tên file mới
                $get_name_image = $get_image->getClientOriginalName();
                // $name_image = current(explode('.', $get_name_image));
                $name_image = pathinfo($get_name_image, PATHINFO_FILENAME);
                $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
                // Di chuyển file mới đến đích
                $get_image->move($path, $new_image);
                $movie->image = $new_image;
            }else{
                return response()->json(['success' => true, 'message' => 'Xóa phim cũ không thành công']);
            }
        }
        else {
            // Giữ nguyên ảnh cũ nếu không có ảnh mới
            $movie->image = $data['current_image'];
        }
        // $movie->fill($data);

        // Nếu trường year không có trong request, giữ nguyên giá trị cũ
        if (empty($data['year'])) {
            $data['year'] = $movie->year;
        }
        $movie->year = $data['year'];
        $movie->date_up = Carbon::now('Asia/Ho_Chi_Minh');
        // Thêm thể loại đầu tiên vào genre_id
        if (isset($data['genre']) && is_array($data['genre']) && count($data['genre']) > 0) {
            $movie->genre_id = $data['genre'][0];
        }

        $movie->save();
        // Cập nhật genres vào bảng trung gian
        if (isset($data['genre'])) {
            $movie->genres()->sync($data['genre']);
        } else {
            $movie->genres()->detach();
        }
        return redirect()->route('watching.index')->with('status', 'Cập nhật thành công!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);
        if (!$movie) {
            return redirect()->back()->withErrors('Phim không tồn tại!');
        }
        // Xóa các tập phim liên quan trước khi xóa phim
        $movie->episodes()->delete();
        if (!empty($movie->image)) {
            if (file_exists('uploads/movie/' . $movie->image)) {
                unlink('uploads/movie/' . $movie->image);
            }
        }
        $movie->delete();
        return redirect()->back()->with('status', 'Xóa thành công!');
    }

    public function updateYear(Request $request)
    {
        // $data = $request->all();
        // $movie = Movie::find($data['id_film']);
        // $movie->year = $data['year'];
        // $movie->save();
        try {
            $data = $request->all();
            $movie = Movie::findOrFail($data['id_film']);  // Sử dụng findOrFail để đảm bảo tìm thấy bản ghi
            // $movie->year = $data['year'];
            $movie->year = $data['year'] ?: null; // Nếu year là rỗng, gán null
            $movie->save();
            return response()->json(['success' => true, 'message' => 'Thay đổi năm phim thành công']);
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Update year error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra'], 500);
        }
    }

    public function updateTopView(Request $request)
    {
        $data = $request->all();
        // Debugging: log dữ liệu nhận được
        Log::info('Received data:', $data);
        if (!isset($data['id_film'])) {
            return response()->json(['success' => false, 'message' => 'Thiếu id_film'], 400);
        }
        $movie = Movie::find($data['id_film']);
        if (!$movie) {
        return response()->json(['success' => false, 'message' => 'Không tìm thấy phim'], 404);
        }
        if (isset($data['topview'])) {
            // Nếu topview có giá trị thì gán giá trị đó, nếu không thì gán null
            $movie->top_view = $data['topview'] !== null ? (int)$data['topview'] : null;
        } else {
            $movie->top_view = null; // Gán null nếu topview không được đặt
        }

        $movie->save();
        return response()->json(['success' => true, 'message' => 'Cập nhật top view thành công']);
    }
    // Start tab filterTopView
    public function filterTopView(Request $request)
    {
        $data = $request->all();
        $value = isset($data['value']) ? intval($data['value']) : null; // đảm bảo tồn tại và là số nguyên
        Log::info('Received value:', ['value' => $value]); // Thêm Log để kiểm tra giá trị nhận được
        $output0 = '';
        $output1 = '';
        $output2 = '';
        try {
            if ($value === 0) {
                // Lọc phim có top_view = 0
                $movies = Movie::where('top_view', 0)->orderBy('views', 'DESC')->take(10)->get();
                $output0 = $this->generateOutput($movies);
            } elseif ($value === 1) {
                // Lọc phim có top_view = 1 và top_view = 0
                $movies0 = Movie::where('top_view', 0)->orderBy('views', 'DESC')->take(6)->get();
                $movies1 = Movie::where('top_view', 1)->orderBy('views', 'DESC')->take(4)->get();
                $output0 = $this->generateOutput($movies0);
                $output1 = $this->generateOutput($movies1);
            } elseif ($value === 2) {
                // Lọc phim có top_view = 2, top_view = 1 và top_view = 0
                $movies0 = Movie::where('top_view', 0)->orderBy('views', 'DESC')->take(4)->get();
                $movies1 = Movie::where('top_view', 1)->orderBy('views', 'DESC')->take(3)->get();
                $movies2 = Movie::where('top_view', 2)->orderBy('views', 'DESC')->take(3)->get();
                $output0 = $this->generateOutput($movies0);
                $output1 = $this->generateOutput($movies1);
                $output2 = $this->generateOutput($movies2);
            } else {
                // return response()->json(['error' => 'Giá trị không hợp lệ'], 400);
                return redirect()->route('404')->with('error', 'Giá trị không hợp lệ');
            }

            return response()->json([
                'output0' => $output0,
                'output1' => $output1,
                'output2' => $output2,
            ]);
        } catch (\Exception $e) {
            Log::error('Error in filterTopView: ' . $e->getMessage());
            return response()->json(['error' => 'Đã xảy ra lỗi'], 500);
        }
    }

    private function generateOutput($movies)
    {
        $output = '';
        foreach ($movies as $mov) {
            if (!is_null($mov) && isset($mov->resolution)) {
                $text = match ($mov->resolution) {
                    0 => 'HD',
                    1 => 'SD',
                    2 => 'HD-Cam',
                    3 => 'Cam',
                    4 => 'FULL-HD',
                    5 => 'Trailer',
                    default => 'Unknown',
                };
                // Lấy giá trị rating từ cơ sở dữ liệu
                $rating = Rating::where('movie_id', $mov->id)->avg('rating'); // Trung bình cộng đánh giá
                $rating = round($rating);

                $output .= '<div id="halim-ajax-popular-post" class="popular-post">
                                <div class="item post-37176">
                                    <a href="'.url('chi-tiet-phim/'.$mov->slug).'" title="'.$mov->title.'">
                                        <div class="item-link">
                                            <img src="'.url('uploads/movie/'.$mov->image).'" alt="'.$mov->title.'" title="'.$mov->title.'" />
                                        <span class="is_trailer" style="background: #365979;">'.$text.'</span>
                                    </div>
                                    <p class="title">'.$mov->title.'</p>
                                </a>
                                <div class="viewsCount" style="color: #9d9d9d;">'.$mov->views.' lượt xem</div>
                                <div class="viewsCount" style="color: #9d9d9d;">'.$mov->year.'</div>
                                <ul class="list-inline rating" title="Average Rating">';
                
                for ($count = 1; $count <= 5; $count++) {
                    $color = ($count <= $rating) ? 'color:#ffcc00;' : 'color:#ccc;';
                    $output .= '<li style="cursor: default; '.$color.' font-size:24px; padding:0;">&#9733;</li>';
                }
                    $output .= '</ul>
                            </div>
                        </div>';
            }
        }
        return $output;
    }
    // End task tab filterTopView

    public function toggleHot(Request $request)
    {
        $movie = Movie::find($request->id);
        if ($movie) {
            $movie->hot = !$movie->hot; // Chuyển đổi trạng thái hot
            $movie->save();
            return response()->json(['success' => true, 'hot' => $movie->hot, 'message' => 'Cập nhật thành công']);
        }
        return response()->json(['success' => false], 404);
    }

    public function toggleStatus(Request $request)
    {
        $movie = Movie::find($request->id);
        if ($movie) {
            $movie->status = !$movie->status; // Chuyển đổi trạng thái status
            $movie->save();
            return response()->json(['success' => true, 'status' => $movie->status, 'message' => 'Cập nhật thành công']);
        }
        return response()->json(['success' => false], 404);
    }
    public function updateCategory(Request $request)
    {
        $movie = Movie::find($request->movie_id);
        if ($movie) {
            $movie->category_id = $request->category_id == 'NULL' ? null : $request->category_id;
            $movie->save();
            $categoryTitle = $movie->category ? $movie->category->title : 'Choose';
            return response()->json(['success' => true, 'category_title' => $categoryTitle, 'message' => 'Cập nhật danh mục thành công']);
        }
        return response()->json(['success' => false]);
    }
    public function updateCountry(Request $request)
    {
        $movie = Movie::find($request->movie_id);
        if ($movie) {
            $movie->country_id = $request->country_id == 'NULL' ? null : $request->country_id;
            $movie->save();
            $countryTitle = $movie->country ? $movie->country->title : 'Choose';
            return response()->json(['success' => true, 'country_title' => $countryTitle, 'message' => 'Cập nhật quốc gia thành công']);
        }
        return response()->json(['success' => false]);
    }
    public function updateSubtitled(Request $request)
    {
        $data = $request->all();
        // Debugging: log dữ liệu nhận được
        Log::info('Received data:', $data);
        if (!isset($data['id_film'])) {
            return response()->json(['success' => false, 'message' => 'Thiếu id_film'], 400);
        }
        $movie = Movie::find($data['id_film']);
        if (!$movie) {
        return response()->json(['success' => false, 'message' => 'Không tìm thấy phim'], 404);
        }
        if (isset($data['subtitled'])) {
            // Nếu subtitled có giá trị thì gán giá trị đó, nếu không thì gán null
            $movie->subtitled = $data['subtitled'] !== null ? (int)$data['subtitled'] : null;
        } else {
            $movie->subtitled = null; // Gán null nếu subtitled không được đặt
        }

        $movie->save();
        return response()->json(['success' => true, 'message' => 'Cập nhật phụ đề thành công']);
    }
    public function updateResolution(Request $request)
    {
        $movie = Movie::find($request->movie_id);
        if ($movie) {
            $movie->resolution = $request->resolution;
            $movie->save();
            return response()->json(['success' => true, 'message' => 'Cập nhật phụ đề thành công']);
        }
        return response()->json(['success' => false]);
    }
    public function updateImage(Request $request)
    {
        $get_image = $request->file('file');
        $movie_id = $request->movie_id;
        if ($get_image) {
            // xóa ảnh cũ
            $movie = Movie::find($movie_id);
            unlink('uploads/movie/'.$movie->image);
            // thêm ảnh mới
            $get_name_image = $get_image->getClientOriginalName(); // ví dụ: 61bc7baa3cf02.jpg
            $name_image = current(explode('.', $get_name_image)); // ví dụ: 61bc7baa3cf02
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/movie', $new_image);
            $movie->image = $new_image;
            $movie->save();
            return response()->json(['success' => true, 'message' => 'Cập nhật hình ảnh thành công']);
        }
        return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra']);
    }
    public function watchVideo(Request $request) {
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $video = Episode::where('movie_id', $data['movie_id'])
            ->where('episode', $data['episode_id'])
            ->first();
    
        $output['video_title'] = $movie->title . ' - Tập ' . $video->episode;
        $output['video_desc'] = $movie->description;
        $output['video_link'] = '<iframe width="560" height="300" src="'.$video->link.'" frameborder="0" allowfullscreen></iframe>';
    
        echo json_encode($output);
    }
    public function sortMovie() {
        $categories = Category::orderBy('position', 'ASC')->get();
        $category_title = [];
        foreach ($categories as $category_home) {
            // Lấy 8 phim thuộc mỗi danh mục có status = 1
            $movies = Movie::withCount('episodes')->where('category_id', $category_home->id)
                        ->where('status', 1)
                        ->orderBy('id', 'DESC')
                        ->take(8)
                        ->get();
            $category_title[] = [
                'category_homepage' => $category_home,
                'movies' => $movies
            ];
        }
        return view('admin.watching.sort-movie', compact('category_title'));
    }
    public function resortingNavbar(Request $request) {
        $data = $request->all();
        foreach ($data['array_id'] as $key => $value) {
            $category = Category::find($value);
            $category->position = $key;
            $category->save();
        }
        return response()->json(['success' => true, 'message' => 'Sắp xếp thứ tự thành công']);
    }
    public function resortingMovie(Request $request) {
        $data = $request->all();
        foreach ($data['array_id'] as $key => $value) {
            $movie = Movie::find($value);
            $movie->position = $key;
            $movie->save();
        }
        return response()->json(['success' => true, 'message' => 'Sắp xếp thứ tự thành công']);
    }
}
