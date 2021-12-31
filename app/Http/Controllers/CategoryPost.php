<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Models\CatePost;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryPost extends Controller
{
	// Admin 
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
   public function add_category_post(){
        $this->AuthLogin();
    	return view('admin.category_post.add_category');
    }
    public function all_category_post(){
        $this->AuthLogin();

        $category_post = CatePost::orderBy('cate_post_id','DESC')->paginate(5);
    	
    	return view('admin.category_post.list_category')->with(compact('category_post'));
    }
    public function save_category_post(Request $request){
        $this->AuthLogin();
    	$data = $request->all();
    	$category_post = new CatePost();
    	$category_post->cate_post_name = $data['cate_post_name'];
    	$category_post->cate_post_status = $data['cate_post_status'];
    	$category_post->cate_post_desc = $data['cate_post_desc'];
    	$category_post->save();
    	
    	Session::put('message','Thêm danh mục bài viết thành công');
    	return redirect()->back();
    }
    public function edit_category_post($category_post_id){
        $this->AuthLogin();
    	$category_post = CatePost::find($category_post_id);
    	
    	return view('admin.category_post.edit_category')->with(compact('category_post'));
    }
    public function update_category_post(Request $request, $cate_post_id){
        $this->AuthLogin();
    	$data = $request->all();
    	$category_post = CatePost::find($cate_post_id);
    	$category_post->cate_post_name = $data['cate_post_name'];
    	$category_post->cate_post_status = $data['cate_post_status'];
    	$category_post->cate_post_desc = $data['cate_post_desc'];
    	$category_post->save();
    	
    	Session::put('message','Cập nhật danh mục bài viết thành công');
    	return redirect('/all-category-post');
    }
    public function delete_category_post($cate_post_id){
        $this->AuthLogin();
        $category_post = CatePost::find($cate_post_id);
        $category_post->delete();
    	
    	Session::put('message','Xóa danh mục bài viết thành công');
    	return redirect()->back();
    }
        
    // // Admin

    // // Customer
    // public function show_category_home($category_id){
    //     $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
    //     $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
    //     $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_product.category_id',$category_id)->get();
    //     $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id',$category_id)->limit(1)->get();
    //     return view('pages.category.show_category')->with('category',$cate_product)->with('brand',$brand_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name);
    // }
    public function danh_muc_bai_viet($cate_post_id){

    }
}
