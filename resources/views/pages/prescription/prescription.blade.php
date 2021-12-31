@extends('layout')

@section('content')

<section id="cart_items">
		<div class="container">
			<div class="row">
            <div class="col-lg-8">
                    <section class="panel">
                        <header class="panel-heading">
                           GỬI TOA THUỐC
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
                                
                                <form role="form" action="{{URL::to('/result')}}" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
<!--                                 <div class="form-group">
                                    
                                    <label for="exampleInputEmail1">Họ và tên</label>
                                    <input type="text" data-validation="length" data-validation-length="min10" data-validation-error-msg="Không được quá 10 ký tự" name="customer_name" class="form-control" id="exampleInputEmail1" >
                                    
                                </div>
                                <div class="form-group">
                                    
                                    <label for="exampleInputEmail1">SDT</label>
                                    <input type="text" name="customer_phone" class="form-control" id="exampleInputEmail1" data-validation-error-msg="Không được để trống" >
                                    
                                </div> -->
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh toa thuốc</label>
                                    <input type="file" name="prescription_image" class="form-control" id="exampleInputEmail1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Ghi chú</label>
                                    <textarea style="resize: none" rows="8" type="password" name="prescription_desc"class="form-control" id="ckeditor1" ></textarea>
                                </div>
                                
                                    <button type="submit" name="result" class="btn btn-info">Gửi</button>
                                </form>
                               
                            </div>

                        </div>
                    </section>

            </div>
		</div>
	</section> <!--/#cart_items-->

@endsection