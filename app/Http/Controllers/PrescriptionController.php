<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\CatePost;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class PrescriptionController extends Controller
{
    public function add_pre(){
        $category_post = CatePost::orderBy('cate_post_id','DESC')->get();
    	$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
    	$brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
    	return view('pages.prescription.prescription')->with('category',$cate_product)->with('brand',$brand_product)->with('category_post',$category_post);   
    }

    public function result(Request $request){
        $category_post = CatePost::orderBy('cate_post_id','DESC')->get();
    	$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
    	$brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
 
        $data = array();
        $data['customer_id'] = Session::get('customer_id');
        // $data['customer_name'] = $request->customer_name;
        // $data['customer_phone'] = $request->customer_phone;
        $data['prescription_desc'] = $request->prescription_desc;
        $get_image = $request->file('prescription_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/prescription',$new_image);
            $data['prescription_image'] = $new_image;
            DB::table('tbl_prescription')->insert($data);

            return view('pages.prescription.result')->with('category',$cate_product)->with('brand',$brand_product)->with('category_post',$category_post); 
        }
        $data['prescription_image'] = '';
        DB::table('tbl_prescription')->insert($data);

    	return view('pages.prescription.result')->with('category',$cate_product)->with('brand',$brand_product);   
    }

    public function manage_prescription(){
    	$all_prescription = DB::table('tbl_prescription')->join('tbl_customer','tbl_prescription.customer_id','=','tbl_customer.customer_id')->get();
        $manage_prescription = view('admin.manage_prescription')->with('all_prescription',$all_prescription);
        return view('admin_layout')->with('admin.manage_prescription',$manage_prescription);
    }

    public function view_prescription($prescriptionId){
        $prescription_by_id = DB::table('tbl_prescription')->where('prescription_id',$prescriptionId)->join('tbl_customer','tbl_prescription.customer_id','=','tbl_customer.customer_id')->first();

        $manage_prescription_by_id = view('admin.view_prescription')->with('prescription_by_id',$prescription_by_id);
        return view('admin_layout')->with('admin.view_prescription',$manage_prescription_by_id);
    }
}
