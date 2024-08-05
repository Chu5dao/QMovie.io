<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Info;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info = Info::find(1);
        return view('admin.info.form', compact('info'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $info = Info::find(1);
        return view('admin.info.form', compact('info'));
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
        $info = Info::find($id);
        if (!$info) {
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
        // Kiểm tra độ dài ký tự trường
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required',
        ], [
            'title.required' => 'Trường Danh Mục là bắt buộc.',
            'title.max' => 'Danh Mục không được dài hơn :max ký tự.',
            'description.required' => 'Trường Mô Tả là bắt buộc.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Tiếp tục xử lý lưu dữ liệu khi validation thành công
        $info = Info::find($id);
        $data = $request->all();
        // 'title', 'description', 'logo', 'created_at', 'updated_at'
        $info->title = $data['title'];
        $info->description = $data['description'];
        $info->copyright = $data['copyright'];
        $info->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        // Xử lý hình ảnh shortcut icon
        $get_image_shortcut_icon = $request->file('shortcut_icon');
        if ($get_image_shortcut_icon) {
            $path = 'uploads/logo';
            // $path = public_path('uploads/movie');
            // Nếu có hình ảnh cũ, kiểm tra xem nó có tồn tại không và xóa nó
            // if (!empty($movie->image) && file_exists($path . '/' . $movie->image)) {
            //     unlink($path . '/' . $movie->image);
            // }
            // Xóa hình ảnh cũ nếu có
            if (!empty($info->shortcut_icon) && file_exists($path . '/' . $info->shortcut_icon)) {
                unlink($path . '/' . $info->shortcut_icon);
                
                // Lấy tên file gốc và tạo tên file mới
                $get_name_image_shortcut_icon = $get_image_shortcut_icon->getClientOriginalName();
                // $name_image = current(explode('.', $get_name_image));
                $name_image_shortcut_icon = pathinfo($get_name_image_shortcut_icon, PATHINFO_FILENAME);
                $new_image_shortcut_icon = $name_image_shortcut_icon . rand(0, 9999) . '.' . $get_image_shortcut_icon->getClientOriginalExtension();
                // Di chuyển file mới đến đích
                $get_image_shortcut_icon->move($path, $new_image_shortcut_icon);
                $info->shortcut_icon = $new_image_shortcut_icon;
            }else{
                // return response()->json(['success' => true, 'message' => 'Xóa logo cũ không thành công']);
                return redirect()->back()->withErrors('Xóa logo cũ không thành công!');
            }
        }
        else {
            // Giữ nguyên ảnh cũ nếu không có ảnh mới
            $info->shortcut_icon = $data['current_image_shortcut_icon'];
        }
        // Xử lý hình ảnh
        $get_image = $request->file('logo');
        if ($get_image) {
            $path = 'uploads/logo';
            // $path = public_path('uploads/movie');
            // Nếu có hình ảnh cũ, kiểm tra xem nó có tồn tại không và xóa nó
            // if (!empty($movie->image) && file_exists($path . '/' . $movie->image)) {
            //     unlink($path . '/' . $movie->image);
            // }
            // Xóa hình ảnh cũ nếu có
            if (!empty($info->logo) && file_exists($path . '/' . $info->logo)) {
                unlink($path . '/' . $info->logo);
                
                // Lấy tên file gốc và tạo tên file mới
                $get_name_image = $get_image->getClientOriginalName();
                // $name_image = current(explode('.', $get_name_image));
                $name_image = pathinfo($get_name_image, PATHINFO_FILENAME);
                $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
                // Di chuyển file mới đến đích
                $get_image->move($path, $new_image);
                $info->logo = $new_image;
            }else{
                // return response()->json(['success' => true, 'message' => 'Xóa logo cũ không thành công']);
                return redirect()->back()->withErrors('Xóa logo cũ không thành công!');
            }
        }
        else {
            // Giữ nguyên ảnh cũ nếu không có ảnh mới
            $info->logo = $data['current_image'];
        }
        // Xử lý hình ảnh logo footer
        $get_image_logo_footer = $request->file('logo_footer');
        if ($get_image_logo_footer) {
            $path = 'uploads/logo';
            // $path = public_path('uploads/movie');
            // Nếu có hình ảnh cũ, kiểm tra xem nó có tồn tại không và xóa nó
            // if (!empty($movie->image) && file_exists($path . '/' . $movie->image)) {
            //     unlink($path . '/' . $movie->image);
            // }
            // Xóa hình ảnh cũ nếu có

            if (!empty($info->logo_footer) && file_exists($path . '/' . $info->logo_footer)) {
                unlink($path . '/' . $info->logo_footer);
                
                // Lấy tên file gốc và tạo tên file mới
                $get_name_image_footer  = $get_image_logo_footer->getClientOriginalName();
                // $name_image = current(explode('.', $get_name_image));
                $name_image_footer  = pathinfo($get_name_image_footer, PATHINFO_FILENAME);
                $new_image_footer  = $name_image_footer . rand(0, 9999) . '.' . $get_image_logo_footer->getClientOriginalExtension();
                // Di chuyển file mới đến đích
                $get_image_logo_footer->move($path, $new_image_footer);
                $info->logo_footer = $new_image_footer;
            }else{
                // return response()->json(['success' => true, 'message' => 'Xóa logo footer cũ không thành công']);
                return redirect()->back()->withErrors('Xóa logo footer cũ không thành công!');
            }
        }
        else {
            // Giữ nguyên ảnh cũ nếu không có ảnh mới
            $info->logo_footer = $data['current_logo_footer'];
        }
        $info->save();

        return redirect('/info/create')->with('status', 'Cập nhật thành công!');
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
