<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Post;
use App\Models\CatePost;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class PostController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_post(){
        $this->AuthLogin();
    	$cate_post = CatePost::orderby('cate_post_id','DESC')->get();
    	
    	return view('admin.post.add_post')->with(compact('cate_post'));
    }
    public function all_post(){
        $this->AuthLogin();
    	$all_post = Post::orderBy('post_id')->paginate(5);
    	
    	return view('admin.post.list_post')->with(compact('all_post'),$all_post);
    }
    public function save_post(Request $request){
        $this->AuthLogin();
    	$data = $request->all();
    	$post = new Post();

    	$post->post_tittle = $data['post_tittle'];
    	$post->post_desc = $data['post_desc'];
    	$post->post_content = $data['post_content'];
    	$post->post_meta_keywords = $data['post_meta_keywords'];
    	$post->post_meta_desc = $data['post_meta_desc'];
    	$post->cate_post_id = $data['cate_post_id'];
    	$post->post_status = $data['post_status'];
 
    	$get_image = $request->file('post_image');

    	if($get_image){
    		$get_name_image = $get_image->getClientOriginalName();
    		$name_image = current(explode('.', $get_name_image));
    		$new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
    		$get_image->move('public/uploads/post',$new_image);
    		$post->post_image = $new_image;
    		$post->save();
    		Session::put('message','Thêm bài viết thành công');
    		return redirect()->back();
    	}

    	else{
    		Session::put('message','Vui lòng thêm hình ảnh');
    		return redirect()->back();
    	}
    }
    // public function edit_product($product_id){
    //     $this->AuthLogin();
    // 	$cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
    // 	$brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

    // 	$edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
    // 	$manager_product = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)->with('brand_product',$brand_product);
    // 	return view('admin_layout')->with('admin.edit_product',$manager_product);
    // }
    // public function update_product(Request $request, $product_id){
    //     $this->AuthLogin();
    // 	$data = array();
    // 	$data['product_name'] = $request->product_name;
    // 	$data['product_price'] = $request->product_price;
    // 	$data['product_desc'] = $request->product_desc;
    // 	$data['product_content'] = $request->product_content;
    // 	$data['category_id'] = $request->product_cate;
    // 	$data['brand_id'] = $request->product_brand;
    // 	$data['product_status'] = $request->product_status;
    // 	$get_image = $request->file('product_image');

    // 	if($get_image){
    // 		$get_name_image = $get_image->getClientOriginalName();
    // 		$name_image = current(explode('.', $get_name_image));
    // 		$new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
    // 		$get_image->move('public/uploads/product',$new_image);
    // 		$data['product_image'] = $new_image;
    // 		DB::table('tbl_product')->where('product_id',$product_id)->update($data);
    // 		Session::put('message','Cập nhật sản phẩm thành công');
    // 		return Redirect::to('all-product');
    // 	}
    // 	DB::table('tbl_product')->where('product_id',$product_id)->update($data);
    // 	Session::put('message','Cập nhật sản phẩm thành công');
    // 	return Redirect::to('all-product');
    // }
    public function delete_post($post_id){
        $this->AuthLogin();
   		$post = Post::find($post_id);
   		$post_image = $post->post_image;
   		
   		if($post_image){
   			$path = 'public/uploads/post/'.$post_image;
   			unlink($path);
   		}
   		$post->delete();
    	Session::put('message','Xóa bài viết thành công');
    	return redirect()->back();
    }

    public function danh_muc_bai_viet($post_id){

        $category_post = CatePost::orderBy('cate_post_id','DESC')->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $cate_post = CatePost::where('cate_post_id',$post_id)->take(1)->get();

        foreach($cate_post as $key => $cate) {
            $cate_id = $cate->cate_post_id;
            $meta_desc = $cate->cate_post_desc;
            $meta_title = $cate->cate_post_name;
        }
        $post = Post::with('cate_post')->where('post_status',0)->where('cate_post_id',$cate_id)->paginate(10);

        return view('pages.baiviet.danhmucbaiviet')->with('category',$cate_product)->with('brand',$brand_product)->with('category_post',$category_post)->with('post',$post);
    }
    public function bai_viet($post_id){
        $category_post = CatePost::orderBy('cate_post_id','DESC')->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $post = Post::with('cate_post')->where('post_status',0)->where('post_id',$post_id)->take(1)->get();

        foreach($post as $key => $p) {
            $cate_id = $p->cate_post_id;
            $meta_desc = $p->post_meta_desc;
            $meta_title = $p->post_tittle;
        }
        

        return view('pages.baiviet.baiviet')->with('category',$cate_product)->with('brand',$brand_product)->with('category_post',$category_post)->with('post',$post);
    }
}
