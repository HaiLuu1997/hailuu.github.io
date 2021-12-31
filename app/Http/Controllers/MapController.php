<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\CatePost;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class MapController extends Controller
{
    public function map1(){
        $category_post = CatePost::orderBy('cate_post_id','DESC')->get();
    	$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        return View('pages.map.chinhanh-1')->with('category',$cate_product)->with('brand',$brand_product)->with('category_post',$category_post);
    }
    public function map2(){
        $category_post = CatePost::orderBy('cate_post_id','DESC')->get();
    	$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        return View('pages.map.chinhanh-2')->with('category',$cate_product)->with('brand',$brand_product)->with('category_post',$category_post);
    }
    public function map3(){
        $category_post = CatePost::orderBy('cate_post_id','DESC')->get();
    	$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        return View('pages.map.chinhanh-3')->with('category',$cate_product)->with('brand',$brand_product)->with('category_post',$category_post);
    }
    public function map4(){
        $category_post = CatePost::orderBy('cate_post_id','DESC')->get();
    	$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        return View('pages.map.chinhanh-4')->with('category',$cate_product)->with('brand',$brand_product)->with('category_post',$category_post);
    }
}
