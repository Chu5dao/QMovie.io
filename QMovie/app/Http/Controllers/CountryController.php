<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Country;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Country::all();
        return view('admin.country.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = Country::all();
        return view('admin.country.form', compact('list'));
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
            'title' => 'required|max:100categories|unique:countries',
            'slug' => 'required|max:255categories|unique:countries',
            'description' => 'required|max:255',
        ], [
            'title.required' => 'Trường Quốc Gia là bắt buộc.',
            'title.max' => 'Quốc Gia không được dài hơn :max ký tự.',
            'title.unique' => 'Quốc Gia này đã tồn tại, hãy nhập ký tự khác',
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
        $country = new Country();
        $country->title = $data['title'];
        $country->slug = $data['slug'];
        $country->description = $data['description'];
        $country->status = $data['status'];
        $country->save();
        return redirect('/country')->with('status', 'Thêm thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Country::find($id);
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
        $country = Country::find($id);
        $list = Country::all();
        return view('admin.country.form', compact('list', 'country'));
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
            'title' => 'required|max:100categories',
            'slug' => 'required|max:255categories',
            'description' => 'required|max:255',
        ], [
            'title.required' => 'Trường Quốc Gia là bắt buộc.',
            'title.max' => 'Quốc Gia không được dài hơn :max ký tự.',
            'title.unique' => 'Quốc Gia này đã tồn tại, hãy nhập ký tự khác',
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
        $country = Country::find($id);
        $country->title = $data['title'];
        $country->slug = $data['slug'];
        $country->description = $data['description'];
        $country->status = $data['status'];
        $country->save();
        return redirect('country')->with('status', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Country::find($id)->delete();
        return redirect('country')->with('status', 'Xóa thành công!');
    }
}
