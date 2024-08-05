<?php

namespace App\Http\Controllers;

use App\Models\ServerMovie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServerMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = ServerMovie::all();
        return view('admin.server_movie.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.server_movie.form');
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
            'title' => 'required|max:100|unique:server_movie',
            'description' => 'required|max:255',
        ], [
            'title.required' => 'Trường Server là bắt buộc.',
            'title.max' => 'Trường Server không được dài hơn :max ký tự.',
            'title.unique' => 'Server này đã tồn tại, hãy nhập ký tự khác',
            'description.required' => 'Trường Mô Tả là bắt buộc.',
            'description.max' => 'Mô Tả không được dài hơn :max ký tự.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Tiếp tục xử lý lưu dữ liệu khi validation thành công
        $data = $request->all();
        $server = new ServerMovie();
        $server->title = $data['title'];
        $server->description = $data['description'];
        $server->status = $data['status'];
        $server->save();
        return redirect('/server/create')->with('status', 'Thêm thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = ServerMovie::find($id);
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
        $server = ServerMovie::find($id);
        return view('admin.server_movie.form', compact('server'));
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
            'description' => 'required|max:255',
        ], [
            'title.required' => 'Trường Server là bắt buộc.',
            'title.max' => 'Trường Server không được dài hơn :max ký tự.',
            'title.unique' => 'Server này đã tồn tại, hãy nhập ký tự khác',
            'description.required' => 'Trường Mô Tả là bắt buộc.',
            'description.max' => 'Mô Tả không được dài hơn :max ký tự.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Tiếp tục xử lý lưu dữ liệu khi validation thành công
        $data = $request->all();
        $server = ServerMovie::find($id);
        $server->title = $data['title'];
        $server->description = $data['description'];
        $server->status = $data['status'];
        $server->save();
        return redirect('server')->with('status', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ServerMovie::find($id)->delete();
        return redirect('/server')->with('status', 'Xóa thành công!');
    }
}
