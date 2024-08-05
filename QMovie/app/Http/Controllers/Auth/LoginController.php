<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Events\UserOnlineStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use BeyondCode\LaravelWebSockets\Apps\App;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    // protected $redirectTo = '/admin'; //sau khi login auto về url '/admin'

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    /**
     * Handle a successful login attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return void
     */
    public function authenticated(Request $request, $user)
    {
        // Phát sự kiện khi người dùng đăng nhập
        event(new UserOnlineStatus($user->id, true));

        // Optionally, you can store the user in a separate table for online users
        // Example: Updating the user status in the database
        DB::table('online_users')->updateOrInsert(
            ['user_id' => $user->id],
            ['updated_at' => now()]
        );
    }

    /**
     * Handle a successful logout attempt.
     *
     * @return \Illuminate\Http\Response
     */
    protected function loggedOut(Request $request)
    {
        // Phát sự kiện khi người dùng đăng xuất
        $userId = Auth::id();
        event(new UserOnlineStatus($userId, false));

        // Optionally, you can remove the user from the online users table
        // Example: Removing the user from the database
        DB::table('online_users')->where('user_id', Auth::id())->delete();
    }
}
