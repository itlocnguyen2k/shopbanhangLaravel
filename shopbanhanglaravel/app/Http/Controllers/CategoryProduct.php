<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProduct extends Controller
{
    public function add_category_product(){
        return view('admin.add_category_product');
    }
    public function all_category_product(){
        $all_category_product = DB::table('category_product')->get();
        $manager_category_product = view('admin.all_category_product')->with('all_category_product',$all_category_product);
        return view('admin_layout')->with('admin.all_category_product',$manager_category_product);
    }
    public function save_category_product(Request $request){
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;
        DB::table('category_product')->insert($data);
        Session::put('message','Thêm danh mục thành công!');
        return Redirect::to('add-category-product');
    }
    public function edit_category_product($category_product_id){
        $edit_category_product = DB::table('category_product')->where('category_id',$category_product_id)->get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);
        return view('admin_layout')->with('admin.edit_category_product',$manager_category_product);
    }
    public function update_category_product(Request $request, $category_product_id){
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;
        DB::table('category_product')->where('category_id',$category_product_id)->update($data);
        Session::put('message','Sửa danh mục thành công!');
        return Redirect::to('all-category-product');
    }
    public function delete_category_product($category_product_id){
        DB::table('category_product')->where('category_id',$category_product_id)->delete();
        Session::put('message','Xóa danh mục thành công!');
        return Redirect::to('all-category-product');
    }
}
