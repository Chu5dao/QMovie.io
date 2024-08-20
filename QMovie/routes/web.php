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
use App\Http\Controllers\LoginFacebookController;
use App\Http\Controllers\LeechMovieController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\ResetPasswordController;

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
Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('admin')->middleware(['role:admin,contributor']);

Auth::routes(['verify' => true]);
Route::middleware('auth')->group(function() {
    // Đổi Password
    Route::get('/change-password', [App\Http\Controllers\Auth\ChangePasswordController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/change-password', [App\Http\Controllers\Auth\ChangePasswordController::class, 'changePassword'])->name('change-password.update');
    // Hiển thị thông tin cá nhân
    Route::get('/user/{id}', [UserController::class, 'getUserById'])->name('user.get');
    Route::get('/user/content/{id}', [UserController::class, 'getUserContent'])->name('user.content');
});

// Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// Route::get('/watching/list', [MovieController::class, 'list'])->name('watching-list')->middleware('role:admin');
// Sắp xếp
Route::post('/drag-and-drop', [CategoryController::class,'resorting'])->name('resorting')->middleware('role:admin');
Route::get('/sort-movie', [MovieController::class,'sortMovie'])->name('sort-movie')->middleware('role:admin');
Route::post('/resorting-navbar', [MovieController::class,'resortingNavbar'])->name('resorting-navbar')->middleware('role:admin');
Route::post('/resorting-movie', [MovieController::class,'resortingMovie'])->name('resorting-movie')->middleware('role:admin');

// Chọn và thêm tập phim
Route::get('/select-movie', [EpisodeController::class, 'selectMovie'])->name('select-movie')->middleware('role:admin');
Route::get('/add-episode/{id}', [EpisodeController::class, 'addEpisode'])->name('add-episode')->middleware(['role:admin,contributor']);
Route::post('/episode/store', [EpisodeController::class, 'storeEpisode'])->name('store-episode')->middleware('role:admin');

// Modal film
Route::post('/watch-video', [MovieController::class, 'watchVideo'])->name('watch-video')->middleware('role:admin');

// Cập nhật Ajax một-nhiều
Route::get('/get-movie-categories', [MovieController::class, 'getMovieCategories'])->name('get-movie-categories')->middleware('role:admin');
Route::get('/update-categories', [MovieController::class, 'updateCategories'])->name('update-categories')->middleware('role:admin');
Route::get('/get-movie-genres', [MovieController::class, 'getMovieGenres'])->name('get-movie-genres')->middleware('role:admin');
Route::get('/update-genres', [MovieController::class, 'updateGenres'])->name('update-genres')->middleware('role:admin');

// Cập nhật Ajax
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
    // Route::resource('episode', EpisodeController::class);
    Route::resource('genre', GenreController::class);
    // Route::resource('watching', MovieController::class);
    Route::resource('info', InfoController::class);
    Route::resource('server', ServerMovieController::class);
});

Route::middleware(['role:admin,contributor'])->group(function () {
    Route::resource('watching', MovieController::class);
    Route::resource('episode', EpisodeController::class);
});
// Quản lý người dùng
Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/admin-users', [UserController::class, 'index'])->name('admin-users.index');
    Route::get('/admin-users/{user}/edit', [UserController::class, 'edit'])->name('admin-users.edit');
    Route::patch('/admin-users/{user}', [UserController::class, 'update'])->name('admin-users.update');
});
// Phát triển Xóa nhiều
Route::delete('/destroy-checked', [EpisodeController::class, 'destroyChecked'])->name('destroy-checked')->middleware('role:admin');

// Route catch-all để trả về trang 404 cho các yêu cầu không hợp lệ
Route::fallback(function() {
    return redirect()->route('404');
});

// Routes Leech Movie (API)
Route::get('/leech-movie', [LeechMovieController::class, 'index'])->name('leech-movie')->middleware('role:admin');
Route::get('/leech-detail/{slug}', [LeechMovieController::class, 'leechDetail'])->name('leech-detail')->middleware('role:admin');
Route::post('/leech-store/{slug}', [LeechMovieController::class, 'leechStore'])->name('leech-store')->middleware('role:admin');
Route::post('/leech-episode/{slug}', [LeechMovieController::class, 'leechEpisode'])->name('leech-episode')->middleware('role:admin');
Route::post('/leech-episode-store/{slug}', [LeechMovieController::class, 'leechEpisodeStore'])->name('leech-episode-store')->middleware('role:admin');

// Google Login URL
// Route::get('auth/google', [LoginGoogleController::class, 'redirectToGoogle']);
// Route::get('auth/google/callback', [LoginGoogleController::class, 'handleGoogleCallback']);
Route::prefix('google')->name('google.')->group( function(){
    Route::get('google/login', [LoginGoogleController::class, 'redirectToGoogle'])->name('login');
    Route::any('callback', [LoginGoogleController::class, 'handleGoogleCallback'])->name('callback');
});

// Facebook Login URL
Route::prefix('facebook')->name('facebook.')->group( function(){
    Route::get('facebook/login', [LoginFacebookController::class, 'redirectToFacebook'])->name('login');
    Route::any('callback', [LoginFacebookController::class, 'handleFacebookCallback'])->name('callback');
});

// Test Redis
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

// Spatie Laravel Activitylog
Route::get('/activity-log', [ActivityLogController::class, 'index'])->name('activity-log')->middleware('role:admin');