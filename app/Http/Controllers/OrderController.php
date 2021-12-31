<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Shipping;
use App\Order;
use App\OrderDetails;
use App\Feeship;
use App\Customer;
use App\Coupon;

class OrderController extends Controller
{
    public function manage_order(){
    	$order = Order::where('updated_at',NULL)->get();
    	return view('admin.manage_order')->with(compact('order'));
    }
    public function view_order($order_code){
    	$order_details = OrderDetails::where('order_code',$order_code)->get();
    	$order = Order::where('order_code',$order_code)->get();
    	foreach($order as $key => $ord){
    		$customer_id = $ord->customer_id;
    		$shipping_id = $ord->shipping_id;
    	}
    	$customer = Customer::where('customer_id',$customer_id)->first();
    	$shipping = Shipping::where('shipping_id',$shipping_id)->first();
    	$order_details = OrderDetails::with('product')->where('order_code',$order_code)->get();
    	foreach($order_details as $key => $order_d){
    		$product_coupon = $order_d->product_coupon;
    	}
    	
    	if($product_coupon!='NO'){
    		$coupon = Coupon::where('coupon_code',$product_coupon)->first();
    		$coupon_condition = $coupon->coupon_condition;
    		$coupon_number = $coupon->coupon_number;
    	}else{
    		$coupon_condition = 2;
    		$coupon_number = 0;
    	}
    	
    	return view('admin.view_order')->with(compact('order_details','customer','shipping','order_details','coupon_condition','coupon_number'));
    }
}
