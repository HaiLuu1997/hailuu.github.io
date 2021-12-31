@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      THÔNG TIN KHÁCH HÀNG
    </div>
    
    <div class="table-responsive">
      <?php 
          $message = Session::get('message');
            if($message){
                echo '<span class="text_alert">', $message ,'</span>';
                Session::put('message',null);
            }
      ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            
            <th>Tên khách hàng</th>
            <th>SĐT</th>
            <th>Email</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          
          <tr>
            
            <td>{{$customer->customer_name}}</td>
            <td>{{$customer->customer_phone}}</td>
            <td>{{$customer->customer_email}}</td>
          </tr>
          
        </tbody>
      </table>
    </div>
    
  </div>
</div>
<br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      THÔNG TIN NGƯỜI NHẬN HÀNG
    </div>
    
    <div class="table-responsive">
      <?php 
          $message = Session::get('message');
            if($message){
                echo '<span class="text_alert">', $message ,'</span>';
                Session::put('message',null);
            }
      ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            
            <th>Tên người nhận</th>
            <th>Địa chỉ</th>
            <th>SĐT</th>
            <th>Email</th>
            <th>Ghi chú</th>
            <th>Hình thức thanh toán</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          
          <tr>
            
            <td>{{$shipping->shipping_name}}</td>
            <td>{{$shipping->shipping_address}}</td>
            <td>{{$shipping->shipping_phone}}</td>
            <td>{{$shipping->shipping_email}}</td>
            <td>{{$shipping->shipping_notes}}</td>
            <td>@if($shipping->shipping_method==0)
                    Chuyển khoản
                @else
                    Tiền mặt
                @endif
            </td>

          </tr>
          
        </tbody>
      </table>
    </div>
    
  </div>
</div>
<br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LIỆT KÊ CHI TIẾT ĐƠN HÀNG
    </div>
    
    <div class="table-responsive">
      <?php 
          $message = Session::get('message');
            if($message){
                echo '<span class="text_alert">', $message ,'</span>';
                Session::put('message',null);
            }
      ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Mã giảm giá</th>
            <th>Phí ship hàng</th>
            <th>Số lượng</th>
            <th>Giá sản phẩm</th>
            <th>Tổng tiền</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php
          $i=0;
          $total=0;
          @endphp
          @foreach($order_details as $key => $detail)
         @php
         $i++;
         $subtotal=$detail->product_price*$detail->product_sales_quantity;
         $total+=$subtotal;
         @endphp
          <tr>
            <td>{{$i}}</td>
            <td>{{$detail->product_name}}</td>
            <td>@if($detail->product_coupon!='NO')
                  {{$detail->product_coupon}}
                @else
                  Không có
                @endif
            </td>
            <td>{{number_format($detail->product_feeship,0,',','.')}} VNĐ</td>
            <td>{{$detail->product_sales_quantity}}</td>
            <td>{{number_format($detail->product_price,0,',','.')}} VNĐ</td>
            <td>{{number_format($subtotal,0,',','.')}} VNĐ</td>
            
          </tr>
          @endforeach
          <tr>
            <td colspan="2"> 
              @php
              $total_coupon = 0;
              @endphp
                @if($coupon_condition == 1)
                    @php
                    $total_after_coupon = ($total*$coupon_number)/100;
                    echo'Tổng giảm:'.number_format($total_after_coupon,0,',','.').'VNĐ'.'</br>';
                    $total_coupon = $total - $total_after_coupon - $detail->product_feeship;
                    @endphp
                @else
                    @php
                    echo'Tổng giảm:'.number_format($coupon_number,0,',','.').'VNĐ'.'</br>';
                    $total_coupon = $total - $coupon_number - $detail->product_feeship;
                    @endphp
                @endif
                Phí ship:{{number_format($detail->product_feeship,0,',','.')}} VNĐ </br>
                Thanh toán:{{number_format($total_coupon,0,',','.')}} VNĐ
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection