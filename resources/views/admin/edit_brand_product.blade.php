@extends('admin_layout')
@section('admin_content')


<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           CẬP NHẬT THƯƠNG HIỆU SẢN PHẨM
                        </header>
                        <?php 
                                $message = Session::get('message');
                                if($message){
                                    echo '<span class="text_alert">', $message ,'</span>';
                                    Session::put('message',null);
                                }
                            ?>
                        <div class="panel-body">
                            
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-brand-product/'.$edit_brand_product->brand_id)}}" method="post">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thương hiệu</label>
                                    <input type="text" value="{{$edit_brand_product->brand_name}}" name="brand_product_name" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
                                    <textarea style="resize: none" rows="8" type="text" name="brand_product_desc"class="form-control" id="exampleInputPassword1">{{$edit_brand_product->brand_desc}}</textarea>
                                </div>
                                
                                <button type="submit" name="update_brand_product"class="btn btn-info">Cập nhật danh mục</button>
                            </form>
                            </div>
                            
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection



