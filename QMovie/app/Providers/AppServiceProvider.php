<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Country;
use App\Models\Rating;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Info;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Services\ActivityLogService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ActivityLogService::class, function ($app) {
            return new ActivityLogService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $info = Info::find(1);
        $category = Category::orderBy('position', 'ASC')->where('status', 1)->get();
        $genre = Genre::orderBy('id')->get();
        $country = Country::orderBy('id')->get();
        $trailer = Movie::where('resolution', 5)->where('status', 1)->orderBy('date_up', 'DESC')->take(10)->get();
        foreach ($trailer as $movie) {
            $rating = Rating::where('movie_id', $movie->id)->avg('rating');
            $movie->average_rating = round($rating);
        }
        $tags_by_views = Movie::select('tags', 'views')
                    ->orderBy('views', 'DESC')
                    ->distinct('tags')
                    ->take(50)->get();
        // total admin
        $category_total = Category::all()->count();
        $genre_total = Genre::all()->count();
        $country_total = Country::all()->count();
        $movie_total = Movie::all()->count();
        // tracking user activity
        // $total_users = DB::table('tracker_sessions')->count(); //'Asia/Ho_Chi_Minh'
        // $total_users_week = DB::table('tracker_sessions')->where('created_at', '>=', Carbon::now('Asia/Ho Chi Minh')->subDays(7))->count();  # Số lượng người dùng trong tuần qua
        // $total_users_month = DB::table('tracker_sessions')->where('created_at', '>=', Carbon::now('Asia/Ho Chi Minh')->subMonth())->count();  # Số lượng người dùng trong tháng qua
        // $total_users_3months = DB::table('tracker_sessions')->where('created_at', '>=', Carbon::now('Asia/Ho Chi Minh'))->subMonths(3)->count();  # Số lượng người dùng trong 3 tháng qua
        // $total_users_thisyear = DB::table('tracker_sessions')->where('created_at', '>=', Carbon::now('Asia/Ho Chi Minh'))->subYear(7)->count();  # Số lượng người dùng trong năm nay

        View::share([
            // 'total_users'=>$total_users,
            // 'total_users_week'=>$total_users_week,
            // 'total_users_month'=>$total_users_month,
            // 'total_users_3months'=>$total_users_3months,
            // 'total_users_thisyear'=>$total_users_thisyear,
            'category_total'=>$category_total,
            'genre_total'=>$genre_total,
            'country_total'=>$country_total,
            'movie_total'=>$movie_total,
            'info'=>$info,
            'category_user'=>$category,
            'genre_user'=>$genre,
            'country_user'=>$country,
            'trailer'=>$trailer,
            'tags_by_views'=>$tags_by_views
        ]);
        // Adding user info to all views if authenticated
        View::composer('*', function ($view) {
            $view->with('authUser', Auth::user());
        });
    }
}
