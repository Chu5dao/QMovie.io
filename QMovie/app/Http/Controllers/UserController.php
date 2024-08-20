<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Phương thức lấy thông tin người dùng theo ID
    public function getUserById($id)
    {
        // Kiểm tra quyền truy cập
        if (Auth::id() != $id) {
            return response()->json(['error' => 'Không có quyền truy cập'], 403);
        }
        // Tìm user theo ID
        $user = User::find($id);

        // Kiểm tra xem user có tồn tại không
        if (!$user) {
            // Nếu không tìm thấy user, quay trở lại trang trước đó và thông báo lỗi
            return redirect()->back()->withErrors(['error' => 'Không có thông tin người dùng']);
        }

        // Nếu tìm thấy, trả về view với thông tin người dùng
        return view('admin.users.account', compact('user'));
    }

    public function getUserContent($id)
    {
        // Kiểm tra quyền truy cập
        if (Auth::id() != $id) {
            return response()->json(['error' => 'Không có quyền truy cập'], 403);
        }
        // Tìm user theo ID
        $user = User::find($id);

        // Kiểm tra xem user có tồn tại không
        if (!$user) {
            // Nếu không tìm thấy user, quay trở lại trang trước đó và thông báo lỗi
            return redirect()->back()->withErrors(['error' => 'Không có thông tin người dùng']);
        }

        // Nếu tìm thấy, trả về view với thông tin người dùng
        return view('admin.users.account-content', compact('user'))->render();
    }

    public function edit(User $user)
    {
        // Định nghĩa các vai trò (role) trực tiếp
        $roles = ['admin', 'user', 'contributor']; // Danh sách các vai trò bạn muốn áp dụng

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => ['required', 'in:admin,user,contributor'],
        ]);
    
        $user->role = $request->input('role');
        $user->save();
    
        return redirect()->route('admin-users.index')->with('status', 'Cập nhật thành công');
    }
}
