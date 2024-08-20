<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    /**
     * Hiển thị form thay đổi mật khẩu.
     *
     * @return \Illuminate\View\View
     */
    public function showChangePasswordForm()
    {
        return view('admin.users.change')->render();
    }

    /**
     * Xử lý yêu cầu thay đổi mật khẩu.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        /** @var User $user */
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save(); // Hàm này nên được IDE nhận diện
        
        return back()->with('status', 'Mật khẩu đã được thay đổi thành công.');
    }
}
