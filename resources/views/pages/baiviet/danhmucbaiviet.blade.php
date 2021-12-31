@extends('layout')

@section('content')

<div class="features_items"><!--features_items-->
                        <h2 class="title text-center">danh mục bài viết</h2>
                        <div class="product-image-wrapper">
                        @foreach($post as $key => $p)
                        	
                                <div class="single-products" style="margin:10px 0;padding: 5px 0">
                                        <div class="productinfo text-center">
                                        	
                                            <img style="float:left;width:30%;padding:5px;height:150px " src="{{URL::to('public/uploads/post/'.$p->post_image)}}" alt="" />
                                            <h4 style="color:#000;padding:5px  ">{{$p->post_tittle}}</h4>
                                            <p style="">{{$p->post_desc}}</p>
                                            
                                        </div>
                                    <div class="text-right">
                                        <a href="{{URL::to('/bai-viet/'.$p->post_id)}}" class="btn btn-default btn-sm">Đọc</a>
                                    </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                        @endforeach
                    </div><!--features_items-->

@endsection