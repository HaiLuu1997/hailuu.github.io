@extends('layout')

@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Giỏ hàng</li>
				</ol>
			</div>
			@if(session()->has('message'))
				<div class="alert alert-success">
					{{session()->get('message')}}
				</div>
			@elseif(session()->has('error'))
				<div class="alert alert-danger">
					{{session()->get('error')}}
				</div>
			@endif
			<div class="table-responsive cart_info">
				<form action="{{URL::to('/update-cart')}}" method="POST" >
					@csrf
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh sản phẩm </td>
							<td class="description">Tên sản phẩm</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Tổng tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@if(Session::get('cart')==true)
						@php
							$total =0;
						@endphp
						@foreach(Session::get('cart') as $key => $cart)
						@php
							$subtotal = $cart['product_price']*$cart['product_qty'];
							$total += $subtotal ;
						@endphp
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{asset('public/uploads/product/'.$cart['product_image'])}}" 
								width="50" alt="{{$cart['product_name']}}"></a>
							</td>
							<td class="cart_description">
								<h4><a href=""></a></h4>
								<p>{{$cart['product_name']}}</p>
								
							</td>
							<td class="cart_price">
								<p>{{number_format($cart['product_price'],0,',','.')}} VNĐ</p> 
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button" >
									
									{{csrf_field()}}
									<input class="cart_quantity_input" type="number" min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}" >
									<input type="hidden" value="" name="rowId_cart" class="form-control">
									

									
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									{{number_format($subtotal,0,',','.')}} VNĐ
								</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/del-product/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
						<tr>
							<td><input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class=" btbtn btn-default check_out">
							</td>
							<td><a class="btn btn-default check_out" href="{{URL::to('/del-all-product')}}">Xóa tất cả</a></td>
							<td>
								@if(Session::get('coupon'))
                                	<a class="btn btn-default check_out" href="{{URL::to('/unset-coupon')}}">Xóa mã khuyến mãi</a>
                                @endif
							</td>

							<td>
								<?php 
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id!=null){
                                ?>
                                	<a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Đặt hàng</a>
                                <?php 
                                }else{
                                ?>
                                	<a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Đặt hàng</a>
                                <?php
                                }
                                ?>
							</td>
							
							<td>
								<li>Tổng <span>{{number_format($total,0,',','.')}} VNĐ</span></li>
								@if(Session::get('coupon'))
								<li> 
									
										@foreach(Session::get('coupon') as $key => $cou)
											@if($cou['coupon_condition']==1)
												Mã giảm:{{$cou['coupon_number']}} %
												<p>
													@php
														$total_coupon = ($total*$cou['coupon_number'])/100;
														echo '<p><li>Tổng giảm :'.number_format($total_coupon,0,',','.').'VNĐ</li></p>';
													@endphp
												</p>
												<p><li>Tổng đã giảm:{{number_format($total-$total_coupon,0,',','.')}}VNĐ</li></p>
											@elseif($cou['coupon_condition']==2)
													Mã giảm:{{number_format($cou['coupon_number'],0,',','.')}} VNĐ
													<p>
														@php
															$total_coupon = $total - $cou['coupon_number'];
														@endphp
													</p>
													<p><li>Tổng đã giảm:{{number_format($total_coupon,0,',','.')}}VNĐ</li></p>
											@endif
										@endforeach
									
								</li>
								@endif
							</td>
						</tr>
						@else
						<tr>
							<td colspan="5" ><center>
							<?php 
								echo 'Vui lòng thêm sản phẩm vào giỏ hàng';
							?>
							</center></td>
						</tr>
						@endif
					</tbody>
					</form>
					@if(Session::get('cart'))
					<tr>
						<td>
                                <form method="POST" action="{{url('/check-coupon')}}" >
                                	@csrf
                                	<input type="text" name="coupon" class="form-control" placeholder="Nhập mã giảm giá"><br>
                                	<input type="submit" name="check_coupon" class="btn btn-default check_coupon" value="Sử dụng mã giảm giá">
                                	
                            	</form>
                        </td>
					</tr>
					@endif
				</table>
			</div>
		</div>
	
@endsection