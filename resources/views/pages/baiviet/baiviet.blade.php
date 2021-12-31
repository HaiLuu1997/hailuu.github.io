@extends('layout')

@section('content')

<div class="features_items"><!--features_items-->
                        <div class="product-image-wrapper">
                        @foreach($post as $key => $p)
                        	
                                <div class="single-products" style="margin:10px 0;padding: 5px 0">
                                        {!!$p->post_content!!}
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                        @endforeach
                    </div><!--features_items-->

@endsection