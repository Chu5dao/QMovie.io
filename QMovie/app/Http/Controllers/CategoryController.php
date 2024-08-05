<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Category::orderBy('position', 'ASC')->get();
        return view('admin.category.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $list = Category::all();
        $list = Category::orderBy('position', 'ASC')->get();
        return view('admin.category.form', compact('list'));
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
            'title' => 'required|max:100|unique:categories',
            'slug' => 'required|max:255|unique:categories',
            'description' => 'required|max:255',
        ], [
            'title.required' => 'Trường Danh Mục là bắt buộc.',
            'title.max' => 'Danh Mục không được dài hơn :max ký tự.',
            'title.unique' => 'Danh Mục này đã tồn tại, hãy nhập ký tự khác',
            'slug.required' => 'Trường Slug là bắt buộc.',
            'slug.max' => 'Slug không được dài hơn :max ký tự.',
            'slug.unique' => 'Slug Danh Mục này đã tồn tại, hãy nhập ký tự khác',
            'description.required' => 'Trường Mô Tả là bắt buộc.',
            'description.max' => 'Mô tả không được dài hơn :max ký tự.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Tiếp tục xử lý lưu dữ liệu khi validation thành công
        $data = $request->all();
        $category = new Category();
        $category->title = $data['title'];
        $category->slug = $data['slug'];
        $category->description = $data['description'];
        $category->status = $data['status'];
        $category->position = $data['position'] = rand(0,99);
        // dd($data);
        $category->save();
        // return redirect()->route('category.index')->with('status', 'Thêm thành công!');
        return redirect(url('/category'))->with('status', 'Thêm thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Category::find($id);
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
        $category = Category::find($id);
        $list = Category::orderBy('position', 'ASC')->get();
        return view('admin.category.form', compact('list', 'category'));
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
            'title.required' => 'Trường Danh Mục là bắt buộc.',
            'title.max' => 'Danh Mục không được dài hơn :max ký tự.',
            'title.unique' => 'Danh Mục này đã tồn tại, hãy nhập ký tự khác',
            'slug.required' => 'Trường Slug là bắt buộc.',
            'slug.max' => 'Slug không được dài hơn :max ký tự.',
            'slug.unique' => 'Slug Danh Mục này đã tồn tại, hãy nhập ký tự khác',
            'description.required' => 'Trường Mô Tả là bắt buộc.',
            'description.max' => 'Mô tả không được dài hơn :max ký tự.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Tiếp tục xử lý lưu dữ liệu khi validation thành công
        $data = $request->all();
        $category = Category::find($id);
        $category->title = $data['title'];
        $category->slug = $data['slug'];
        $category->description = $data['description'];
        $category->status = $data['status'];
        $category->position = $data['position'];
        $category->save();
        return redirect('/category')->with('status', 'Cập nhật thành công!');
        // return redirect()->route('your.route')->with('status', 'Action was successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect('/category')->with('status', 'Xóa thành công!');
    }
    public function resorting(Request $request)
    {
        $data = $request->all();
        foreach ($data['array_id'] as $key => $value) {
            $category = Category::find($value);
            $category->position = $key;
            $category->save();
        }
        return response()->json(['success' => true, 'message' => 'Sắp xếp thứ tự thành công']);
    }
}
