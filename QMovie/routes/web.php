<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\ServerMovieController;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\LoginGoogleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [IndexController::class, 'home'])->name('homepage');
Route::get('/home', [IndexController::class, 'home'])->name('home');
Route::get('/danh-muc/{slug}', [IndexController::class, 'category'])->name('category');
Route::get('/nam/{year}', [IndexController::class, 'year'])->name('year');
Route::get('/the-loai/{slug}', [IndexController::class, 'genre'])->name('genre');
Route::get('/quoc-gia/{slug}', [IndexController::class, 'country'])->name('country');
Route::get('/chi-tiet-phim/{slug}', [IndexController::class, 'detail'])->name('detail');
Route::get('/tu-khoa/{tag}', [IndexController::class, 'tag'])->name('tag');
Route::get('/tim-kiem', [IndexController::class, 'search'])->name('search');
Route::get('/404', [IndexController::class, 'error'])->name('404');
Route::get('/xem-phim/{slug}/{tap}', [IndexController::class, 'watching'])->name('watching');
Route::get('/tap', [IndexController::class, 'episode'])->name('episode-user');
Route::get('/loc-phim', [IndexController::class, 'filterFilm'])->name('filter-film');
Route::get('/sap-xep-xu-huong', [MovieController::class, 'filterTopView'])->name('filter-top-view');
Route::post('/them-danh-gia', [IndexController::class, 'addRating'])->name('add-rating');

//Routes Admin
Auth::routes();
Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('admin');
// Route::post('drag-and-drop', [MovieController::class,'resorting'])->name('resorting');
// đặt name thì url->route()
Route::get('/watching/list', [MovieController::class, 'list'])->name('watching-list')->middleware('role:admin');
Route::post('/drag-and-drop', [CategoryController::class,'resorting'])->name('resorting')->middleware('role:admin');
Route::get('/sort-movie', [MovieController::class,'sortMovie'])->name('sort-movie')->middleware('role:admin');
Route::post('/resorting-navbar', [MovieController::class,'resortingNavbar'])->name('resorting-navbar')->middleware('role:admin');
Route::post('/resorting-movie', [MovieController::class,'resortingMovie'])->name('resorting-movie')->middleware('role:admin');

Route::get('/select-movie', [EpisodeController::class, 'selectMovie'])->name('select-movie')->middleware('role:admin');
Route::get('/add-episode/{id}', [EpisodeController::class, 'addEpisode'])->name('add-episode')->middleware('role:admin');
Route::post('/episode/store', [EpisodeController::class, 'storeEpisode'])->name('store-episode')->middleware('role:admin');
Route::post('/watch-video', [MovieController::class, 'watchVideo'])->name('watch-video')->middleware('role:admin');

Route::post('/update-year-film', [MovieController::class, 'updateYear'])->name('update-year-film')->middleware('role:admin');
Route::post('/update-topview-film', [MovieController::class, 'updateTopView'])->name('update-topview-film')->middleware('role:admin');
Route::post('/toggle-hot', [MovieController::class, 'toggleHot'])->name('toggle-hot')->middleware('role:admin');
Route::post('/toggle-status', [MovieController::class, 'toggleStatus'])->name('toggle-status')->middleware('role:admin');
Route::post('/update-category', [MovieController::class, 'updateCategory'])->name('update-category')->middleware('role:admin');
Route::post('/update-country', [MovieController::class, 'updateCountry'])->name('update-country')->middleware('role:admin');
Route::post('/update-subtitled', [MovieController::class, 'updateSubtitled'])->name('update-subtitled')->middleware('role:admin');
Route::post('/update-resolution', [MovieController::class, 'updateResolution'])->name('update-resolution')->middleware('role:admin');
Route::post('/update-image', [MovieController::class, 'updateImage'])->name('update-image')->middleware('role:admin');

// Route::resource('/category', CategoryController::class)->middleware('role:admin');
Route::middleware(['role:admin'])->group(function () {
    Route::resource('category', CategoryController::class);
    Route::resource('country', CountryController::class);
    Route::resource('episode', EpisodeController::class);
    Route::resource('genre', GenreController::class);
    Route::resource('watching', MovieController::class);
    Route::resource('info', InfoController::class);
    Route::resource('server', ServerMovieController::class);
});

// Route catch-all để trả về trang 404 cho các yêu cầu không hợp lệ
Route::fallback(function() {
    return redirect()->route('404');
});

Route::get('/test-redis', function () {
    try {
        $sessionId = session()->getId();
        Redis::setex('test-key', 60, 'test-value');
        $value = Redis::get('test-key');
        return 'Redis connection is working. Value: ' . $value . ', Session ID: ' . $sessionId;
    } catch (\Exception $e) {
        return 'Redis connection failed: ' . $e->getMessage();
    }
});

// Google Login URL
// Route::get('auth/google', [LoginGoogleController::class, 'redirectToGoogle']);
// Route::get('auth/google/callback', [LoginGoogleController::class, 'handleGoogleCallback']);
Route::prefix('google')->name('google.')->group( function(){
    Route::get('google/login', [LoginGoogleController::class, 'redirectToGoogle'])->name('login');
    Route::any('callback', [LoginGoogleController::class, 'handleGoogleCallback'])->name('callback');
});