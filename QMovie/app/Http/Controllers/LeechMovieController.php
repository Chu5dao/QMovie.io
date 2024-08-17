<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Episode;
use App\Models\ServerMovie;

class LeechMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->input('page', 0); // Mặc định trang là 0
        $resp = Http::get("https://ophim1.com/danh-sach/phim-moi-cap-nhat?page=$page")->json();
        // dd($resp);
        // $resp = Http::get("https://ophim1.com/danh-sach/phim-moi-cap-nhat?page=1")->json();
        return view('admin.leech.index', compact('resp', 'page'));
    }
    public function leechDetail($slug)
    {
        $resp = Http::get("https://ophim1.com/phim/".$slug)->json();
        $resp_movie[] = $resp['movie'];
        return view('admin.leech.leech-detail', compact('resp_movie'));
    }
    function standardizeDuration($duration) {
        // Chuyển đổi định dạng '1g 50ph' hoặc '45 phút/tập'
        if (preg_match('/(\d+)\s*g\s*(\d+)\s*ph/i', $duration, $matches)) {
            $hours = $matches[1];
            $minutes = $matches[2];
            $totalMinutes = ($hours * 60) + $minutes;
            return "{$totalMinutes} Phút";
        }
        
        // Chuyển đổi định dạng '59 phút/tập'
        if (preg_match('/(\d+)\s*phút\s*\/\s*tập/i', $duration, $matches)) {
            $minutes = $matches[1];
            return "{$minutes} Phút / Tập";
        }
        
        // Trả về giá trị ban đầu nếu không khớp
        return $duration;
    }
    public function leechStore(Request $request, $slug)
    {
        $resp = Http::get("https://ophim1.com/phim/".$slug)->json();
        $resp_movie[] = $resp['movie'];
        $movie = new Movie();
        foreach ($resp_movie as $key => $res) {
            $movie->title = $res['name'];
            $movie->trailer = $res['trailer_url'];
            $movie->ep_number = $res['episode_total'];
            $movie->tags = $res['name'].','.$res['slug'];
            $movie->duration = $this->standardizeDuration($res['time']);
            $movie->subtitled = 0;
            $movie->resolution = 0;
            $movie->slug = $res['slug'];
            $movie->name_eng = $res['origin_name'].'('.$res['year'].')';
            $movie->hot = 0;
            $movie->description = $res['content'];
            $movie->status = 0;
            $movie->date_cr = Carbon::now('Asia/Ho_Chi_Minh');
            $movie->date_up = Carbon::now('Asia/Ho_Chi_Minh');
            $movie->image = $res['thumb_url'];
            $movie->views = $res['view'];
            $movie->year = $res['year'];
            $category = Category::orderBy('id', 'DESC')->first();
            $movie->category_id = $category->id;
            $country = Country::orderBy('id', 'DESC')->first();
            $movie->country_id = $country->id;
            $genre = Genre::orderBy('id', 'DESC')->first();
            $movie->genre_id = $genre->id;

            $movie->save();

            $movie->genres()->attach($genre);
        }
        return redirect()->back()->with('status', 'Thêm thành công!');
    }

    public function leechEpisode($slug)
    {
        $resp = Http::get("https://ophim1.com/phim/".$slug)->json();
        return view('admin.leech.leech-episode', compact('resp'));
    }
    
    public function leechEpisodeStore(Request $request, $slug){
        $movie = Movie::where('slug', $slug)->first();
        $resp = Http::get("https://ophim1.com/phim/".$slug)->json();
        foreach($resp['episodes'] as $key => $res){
            foreach($res['server_data'] as $key_data => $res_data){
                $ep = new Episode();
                $ep->movie_id = $movie->id;
                $ep->link = $res_data['link_embed'];
                // Tập phim API
                if ($res_data['name'] == 'Full') {
                    $ep->episode = 1;
                } else {
                    $ep->episode = $res_data['name'];
                }
                // Server phim API
                if ($key_data==0) {
                    $linkmovie = ServerMovie::orderBy('id', 'DESC')->first();
                    $ep->server = $linkmovie->id;
                } else {
                    $linkmovie = ServerMovie::orderBy('id', 'ASC')->first();
                    $ep->server = $linkmovie->id;
                }
                $ep->date_cr = Carbon::now('Asia/Ho_Chi_Minh');
                $ep->date_up = Carbon::now('Asia/Ho_Chi_Minh');
        
                $ep->save();
            }
        }
        return redirect(route('leech-movie'))->with('status', 'Thêm thành công!');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
