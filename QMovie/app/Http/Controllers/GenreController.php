<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Genre::all();
        return view('admin.genre.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = Genre::all();
        return view('admin.genre.form', compact('list'));
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
            'title' => 'required|max:100|unique:genres',
            'slug' => 'required|max:255|unique:genres',
            'description' => 'required|max:255',
        ], [
            'title.required' => 'Trường Thể Loại là bắt buộc.',
            'title.max' => 'Thể Loại không được dài hơn :max ký tự.',
            'title.unique' => 'Thể Loại này đã tồn tại, hãy nhập ký tự khác',
            'slug.required' => 'Trường Slug là bắt buộc.',
            'slug.max' => 'Slug không được dài hơn :max ký tự.',
            'slug.unique' => 'Slug này đã tồn tại, hãy nhập ký tự khác',
            'description.required' => 'Trường Mô Tả là bắt buộc.',
            'description.max' => 'Mô Tả không được dài hơn :max ký tự.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Tiếp tục xử lý lưu dữ liệu khi validation thành công
        $data = $request->all();
        $genre = new Genre();
        $genre->title = $data['title'];
        $genre->slug = $data['slug'];
        $genre->description = $data['description'];
        $genre->status = $data['status'];
        $genre->save();
        return redirect()->route('genre.index')->with('status', 'Thêm thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Genre::find($id);
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
        $genre = Genre::find($id);
        $list = Genre::all();
        return view('admin.genre.form', compact('list', 'genre'));
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
            'slug' => 'required|max:255',
            'description' => 'required|max:255',
        ], [
            'title.required' => 'Trường Thể Loại là bắt buộc.',
            'title.max' => 'Thể Loại không được dài hơn :max ký tự.',
            'title.unique' => 'Thể Loại này đã tồn tại, hãy nhập ký tự khác',
            'slug.required' => 'Trường Slug là bắt buộc.',
            'slug.max' => 'Slug không được dài hơn :max ký tự.',
            'slug.unique' => 'Slug này đã tồn tại, hãy nhập ký tự khác',
            'description.required' => 'Trường Mô Tả là bắt buộc.',
            'description.max' => 'Mô Tả không được dài hơn :max ký tự.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Tiếp tục xử lý lưu dữ liệu khi validation thành công
        $data = $request->all();
        $genre = Genre::find($id);
        $genre->title = $data['title'];
        $genre->slug = $data['slug'];
        $genre->description = $data['description'];
        $genre->status = $data['status'];
        $genre->save();
        return redirect('/genre')->with('status', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Genre::find($id)->delete();
        return redirect('/genre')->with('status', 'Xóa thành công!');
    }
}
