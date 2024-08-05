<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Movie_Genre;
use App\Models\Rating;
use App\Models\Info;
use App\Models\ServerMovie;
// use DB;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IndexController extends Controller
{
    // trang home
    public function home(){
        $info = Info::find(1);
        $meta_title = $info->title;
        $meta_description = $info->description;
        $meta_image = url('uploads/logo/ffz7gikh3941.png');

        $phimhot = Movie::withCount('episodes')->where('hot', 1)->where('status', 1)->orderBy('date_up', 'DESC')->get();
        // Lấy danh sách danh mục và kèm theo phim thuộc từng danh mục
        // $category_title = Category::orderBy('id')->get();
        // Lấy danh sách các danh mục
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

        $category_home = Category::with('movie')->orderBy('id')->where('status', 1)->get(); // đã bỏ vì Ẩn Phim mới Body
        return view('pages.home', compact('phimhot', 'category_title', 'meta_title', 'meta_description', 'meta_image'));
    }
    // trang category
    public function category($slug){
        $cate_slug = Category::where('slug', $slug)->first();
        $meta_title = $cate_slug->title;
        $meta_description = $cate_slug->description;
        $meta_image = url('uploads/logo/ffz7gikh3941.png');

        $phimhot_sidebar = Movie::with('ratings')->withCount('episodes')->where('hot', 1)->where('status', 1)->orderBy('date_up', 'DESC')->take(5)->get();
        foreach ($phimhot_sidebar as $movie) {
            $rating = Rating::where('movie_id', $movie->id)->avg('rating');
            $movie->average_rating = round($rating);
        }
        $movie = Movie::withCount('episodes')->where('category_id', $cate_slug->id)->where('status', 1)->orderBy('date_up', 'DESC')->paginate(60);
        return view('pages.category', compact('cate_slug', 'movie', 'phimhot_sidebar', 'meta_title', 'meta_description', 'meta_image'));
    }

    public function genre($slug){
        $genre_slug = Genre::where('slug', $slug)->first();
        $meta_title = $genre_slug->title;
        $meta_description = $genre_slug->description;
        $meta_image = url('uploads/logo/ffz7gikh3941.png');
        
        $phimhot_sidebar = Movie::with('ratings')->withCount('episodes')->where('hot', 1)->where('status', 1)->orderBy('date_up', 'DESC')->take(5)->get();
        foreach ($phimhot_sidebar as $movie) {
            $rating = Rating::where('movie_id', $movie->id)->avg('rating');
            $movie->average_rating = round($rating);
        }       
        // nhiều thể loại
        $movie_genre = Movie_Genre::where('genre_id', $genre_slug->id)->get();
        $many_genre = [];
        foreach($movie_genre as $key => $movi){
            $many_genre[] = $movi->movie_id;
        }
        $movie = Movie::withCount('episodes')->whereIn('id', $many_genre)->where('status', 1)->orderBy('date_up', 'DESC')->paginate(60);
        return view('pages.genre', compact('genre_slug', 'movie', 'phimhot_sidebar', 'meta_title', 'meta_description', 'meta_image'));
    }

    public function country($slug){
        $country_slug = Country::where('slug', $slug)->first();
        $meta_title = $country_slug->title;
        $meta_description = $country_slug->description;
        $meta_image = url('uploads/logo/ffz7gikh3941.png');

        $phimhot_sidebar = Movie::with('ratings')->withCount('episodes')->where('hot', 1)->where('status', 1)->orderBy('date_up', 'DESC')->take(5)->get();
        foreach ($phimhot_sidebar as $movie) {
            $rating = Rating::where('movie_id', $movie->id)->avg('rating');
            $movie->average_rating = round($rating);
        }
        $movie = Movie::withCount('episodes')->where('country_id', $country_slug->id)->where('status', 1)->orderBy('date_up', 'DESC')->paginate(60);
        return view('pages.country', compact('country_slug', 'movie', 'phimhot_sidebar', 'meta_title', 'meta_description', 'meta_image'));
    }

    public function detail($slug){
        $phimhot_sidebar = Movie::with('ratings')->withCount('episodes')->where('hot', 1)->where('status', 1)->orderBy('date_up', 'DESC')->take(5)->get();
        foreach ($phimhot_sidebar as $movie) {
            $rating = Rating::where('movie_id', $movie->id)->avg('rating');
            $movie->average_rating = round($rating);
        }     
        // Lấy thông tin chi tiết của phim dựa vào slug
        $movie = Movie::withCount('episodes')->with('category','genres','country')->where('slug', $slug)->where('status', 1)->first();
        // Kiểm tra nếu $movie là null
        if (!$movie) {
            // Bạn có thể chuyển hướng đến trang lỗi hoặc trang không tìm thấy phim
            return redirect()->route('404')->with('error', 'Phim không tồn tại hoặc đã bị xóa.');
        }
        $meta_title = $movie->title;
        $meta_description = $movie->description;
        $meta_image = url('uploads/movie/'.$movie->image);
        // ====================================================
        $movie_related = Movie::withCount('episodes')->with('category','genres','country')->where('category_id', $movie->category->id)->orderby(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->where('status', 1)->get();
        // lấy 3 tập mới nhất
        $episode = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('episode', 'DESC')->take(3)->get();
        // lấy tập 1
        $episode_default =  Episode::with('movie')->where('movie_id', $movie->id)->orderBy('episode', 'ASC')->take(1)->first();
        if (!$episode_default) {
            $episode = collect(); // Tạo một tập rỗng để tránh lỗi
            $episode_default = null;
            session()->flash('detail_status', 'Phim đang cập nhật');
        }
        // Rating
        $rating = Rating::where('movie_id', $movie->id)->avg('rating'); // Trung bình cộng đánh giá
        $rating = round($rating);
        $count_total = Rating::where('movie_id', $movie->id)->count(); // Tổng số lượng đánh giá
        // return response()->json($episode_default);
        return view('pages.detail', compact('movie','movie_related', 'episode', 'episode_default', 'phimhot_sidebar', 'rating', 'count_total', 'meta_title', 'meta_description', 'meta_image'));
    }

    public function addRating(Request $request) {
        $ip_address = $request->ip(); // Lấy địa chỉ IP của người dùng
        $movie_id = $request->input('movie_id');
        $rating = $request->input('rating');
        $existingRating = Rating::where('ip_address', $ip_address)->where('movie_id', $movie_id)->first();
    
        if ($existingRating) {
            // Cập nhật đánh giá
            $existingRating->rating = $rating;
            $existingRating->save();
            return response()->json('updated');
        } else {
            // Thêm đánh giá mới
            $newRating = new Rating();
            $newRating->ip_address = $ip_address;
            $newRating->movie_id = $movie_id;
            $newRating->rating = $rating;
            $newRating->save();
            return response()->json('added');
        }
    }

    public function watching($slug, $tap){
        $phimhot_sidebar = Movie::with('ratings')->withCount('episodes')->where('hot', 1)->where('status', 1)->orderBy('date_up', 'DESC')->take(5)->get();
        foreach ($phimhot_sidebar as $movie) {
            $rating = Rating::where('movie_id', $movie->id)->avg('rating');
            $movie->average_rating = round($rating);
        }
        $movie = Movie::withCount('episodes')->with('category','genres','country', 'episodes')->where('slug', $slug)->where('status', 1)->first();
        if (!$movie) {
            return redirect()->route('404')->with('error', 'Phim không tồn tại hoặc đã bị xóa.');
        }
        $meta_title = $movie->title;
        $meta_description = $movie->description;
        $meta_image = url('uploads/movie/'.$movie->image);
        // ====================================================
        $movie_related = Movie::withCount('episodes')->with('category','genres','country')->where('category_id', $movie->category->id)->orderby(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->where('status', 1)->get();
        // ====================================================
        // Lấy các tập phim cùng slug
        $movies_add = Movie::with('category', 'genres', 'country', 'episodes')->where('slug', $slug)->get();
        if ($movies_add->isEmpty()) {
            return redirect()->route('404')->with('error', 'Không tìm thấy các bản phim khác.');
        }
        // Lấy các tập phim của tất cả các phim có cùng slug
        $episodes_add = collect();
        foreach ($movies_add as $movie_item) {
            $episodes = Episode::where('movie_id', $movie_item->id)->orderBy('episode', 'ASC')->get();
            $episodes_add = $episodes_add->merge($episodes);
        }
        // Sắp xếp lại tập phim theo thứ tự tập
        $episodes_add = $episodes_add->sortBy('episode');
        // ====================================================
            // Lấy tập phim dựa vào $tap hoặc tập đầu tiên
            $tap_valid = ['HD', 'SD', 'HD-Cam', 'Cam', 'Full-HD'];
            if (isset($tap)) {
                // Giả sử $tap có định dạng như "tap-HD" hoặc "tap-5"
                $tap_value = substr($tap, 4, 7); // Trích xuất từ vị trí thứ 4 đến hết chuỗi
                // Kiểm tra nếu $tap_value nằm trong $tap_valid
                if (in_array($tap_value, $tap_valid)) {
                    $tapphim = '1'; // Nếu nằm trong danh sách hợp lệ, gán giá trị đó
                } elseif (is_numeric($tap_value)){
                    // Nếu $tap không nằm trong $tap_valid, kiểm tra nếu đó là một số
                    $tapphim = (int) $tap_value; // Chuyển $tap_value thành số nguyên
                } else {
                    return redirect()->route('404')->with('error', 'Tập phim không tồn tại.');
                }
            }
        // Tìm tập phim hiện tại dựa trên $tapphim
        $episode = $episodes_add->firstWhere('episode', $tapphim);
        if (!$episode) {
            $episode = $episodes_add->first();
        }
        // $episode = Episode::where('movie_id', $movie->id)->where('episode', $tapphim)->first();
        // if (!$episode) {
        //     return redirect()->route('404')->with('error', 'Tập phim không tồn tại.');
        // }
        // return response()->json($episodes_add);
        // cập nhật lượt view theo mỗi lần vào trang xem
        $views = $movie->views;
        $views = $views + 1;
        $movie->views = $views;
        $movie->save();
        // Lấy danh sách server chỉ chứa các tập phim
        $server_list = ServerMovie::whereHas('episodes', function($query) use ($movie) {
            $query->where('movie_id', $movie->id);
        })->orderBy('id', 'DESC')->get();
        if (!$server_list) {
            return redirect()->route('404')->with('error', 'Server lỗi.');
        }
        // Debug: Kiểm tra dữ liệu
        // dd(compact('movie', 'movies_add', 'episode', 'tapphim', 'episodes_add', 'server_list'));
        // dd($server_list, $episodes_add);
        return view('pages.watching', compact('movie', 'movie_related', 'episode', 'tapphim', 'episodes_add', 'movies_add', 'phimhot_sidebar', 'meta_title', 'meta_description', 'meta_image', 'server_list'));
    }

    public function year($year){
        $meta_title = 'Năm phim: '.$year;
        $meta_description = 'Tìm phim năm: '.$year;
        $meta_image = url('uploads/logo/ffz7gikh3941.png');
        
        $phimhot_sidebar = Movie::with('ratings')->withCount('episodes')->where('hot', 1)->where('status', 1)->orderBy('date_up', 'DESC')->take(5)->get();
        foreach ($phimhot_sidebar as $movie) {
            $rating = Rating::where('movie_id', $movie->id)->avg('rating');
            $movie->average_rating = round($rating);
        }      
        $year = $year;
        $movie = Movie::withCount('episodes')->where('year', $year)->where('status', 1)->orderBy('date_up', 'DESC')->paginate(60);
        return view('pages.year', compact('year','movie', 'phimhot_sidebar', 'meta_title', 'meta_description', 'meta_image'));
    }

    public function tag($tag){
        $meta_title = $tag;
        $meta_description = $tag;
        $meta_image = url('uploads/logo/ffz7gikh3941.png');

        $phimhot_sidebar = Movie::with('ratings')->withCount('episodes')->where('hot', 1)->where('status', 1)->orderBy('date_up', 'DESC')->take(5)->get();
        foreach ($phimhot_sidebar as $movie) {
            $rating = Rating::where('movie_id', $movie->id)->avg('rating');
            $movie->average_rating = round($rating);
        }
        $tag = $tag;
        $movie = Movie::withCount('episodes')->where('tags', 'LIKE', '%'.$tag.'%')->where('status', 1)->orderBy('date_up', 'DESC')->paginate(60);
        return view('pages.tag', compact('tag', 'movie', 'phimhot_sidebar', 'meta_title', 'meta_description', 'meta_image'));
    }

    public function search(Request $request) {
        $phimhot_sidebar = Movie::with('ratings')->withCount('episodes')->where('hot', 1)->where('status', 1)->orderBy('date_up', 'DESC')->take(5)->get();
        foreach ($phimhot_sidebar as $movie) {
            $rating = Rating::where('movie_id', $movie->id)->avg('rating');
            $movie->average_rating = round($rating);
        }
        $search = $request->input('search');
        $movie = Movie::withCount('episodes')->where('title', 'LIKE', '%'.$search.'%')->where('status', 1)->orderBy('date_up', 'DESC')->paginate(60);
        $meta_title = 'Tìm kiếm: '.$search;
        $meta_description ='Tìm kiếm: '.$search;
        $meta_image = url('uploads/logo/ffz7gikh3941.png');
        if ($search) {
            if ($movie->isEmpty()) {
                // Nếu không có kết quả, trả về view với thông báo không tìm thấy
                return view('pages.search', compact('movie', 'phimhot_sidebar', 'meta_title', 'meta_description', 'meta_image'))
                    ->with('search', $search)
                    ->with('status', 'Không tìm thấy kết quả phù hợp');
            } else {
                // Nếu có kết quả, trả về view với kết quả tìm kiếm
                return view('pages.search', compact('movie', 'phimhot_sidebar', 'meta_title', 'meta_description', 'meta_image'))
                    ->with('search', $search);
            }
        } else {
            return redirect()->route('404')->with('error', 'Liên kết không hợp lệ');
        }
    }

    public function error()
    {
        $meta_title = '404 not found';
        $meta_description = '404 not found';
        $meta_image = url('uploads/logo/ffz7gikh3941.png');
        $phimhot_sidebar = Movie::with('ratings')->withCount('episodes')->where('hot', 1)->where('status', 1)->orderBy('date_up', 'DESC')->take(5)->get();
        foreach ($phimhot_sidebar as $movie) {
            $rating = Rating::where('movie_id', $movie->id)->avg('rating');
            $movie->average_rating = round($rating);
        }
        return view('pages.404', compact('phimhot_sidebar', 'meta_title', 'meta_description', 'meta_image'));
        // return response()->json($tags_by_views);
    }

    public function filterFilm(Request $request)
    {
        $order_get = $request->query('order', '');
        $genre_get = $request->query('genre', '');
        $country_get = $request->query('country', '');
        $year_get = $request->query('year', '');

        // Đặt các giá trị meta
        $meta_title = "Lọc phim";
        $meta_description = "Lọc phim";
        $meta_image = url('uploads/logo/ffz7gikh3941.png');
        // lấy dữ liệu
        // Lấy ra phim và đếm số tập
        $movie_array = Movie::withCount('episodes'); 
        // Nếu có giá trị $genre_get
        if ($genre_get) {
            $movie_array = $movie_array->where('genre_id', $genre_get);
        }
        // Nếu có giá trị $country_get
        if ($country_get) {
            $movie_array = $movie_array->where('country_id', $country_get);
        }
        // Nếu có giá trị $year_get
        if ($year_get) {
            $movie_array = $movie_array->where('year', $year_get);
        }
        // Nếu có giá trị $order_get
        if ($order_get) {
            $movie_array = $movie_array->orderBy($order_get, 'DESC');
        }
        // Liên kết với bảng 'movie_genre'
        $movie_array = $movie_array->with('movie_genre');
        // Khởi tạo mảng $movie rỗng
        // $movie = array();
        // foreach($movie_array as $mov){
        //     foreach($mov->movie_genre as $mov_gen){
        //         $movie = $movie_array->whereIn('genre_id', [$mov_gen->genre_id]);
        //     }
        // }
        $movies = $movie_array->paginate(60);
        // Kiểm tra số lượng phim được tìm thấy
        $movies_count = $movies->total();

        $phimhot_sidebar = Movie::with('ratings')->withCount('episodes')->where('hot', 1)->where('status', 1)->orderBy('date_up', 'DESC')->take(5)->get();
        foreach ($phimhot_sidebar as $movie) {
            $rating = Rating::where('movie_id', $movie->id)->avg('rating');
            $movie->average_rating = round($rating);
        }
        // Kiểm tra movies_count
        if ($movies_count === 0) {
            session()->flash('status_filter', 'Không có Phim');
            return view('pages.show-filter-film', compact('movies', 'meta_title', 'meta_description', 'meta_image', 'phimhot_sidebar'));
            // return response()->json($movies_count);
        } else {
            return view('pages.show-filter-film', compact('movies', 'meta_title', 'meta_description', 'meta_image', 'phimhot_sidebar'));
        }
    }
}
