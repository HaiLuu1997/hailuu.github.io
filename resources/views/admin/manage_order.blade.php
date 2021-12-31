@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LIỆT KÊ ĐƠN HÀNG
    </div>
    <div class="row w3-res-tb">
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
            <th>Mã đơn hàng</th>
            
            <th>Tình trạng đơn hàng</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php
          $i = 0;
          @endphp
          @foreach($order as $key => $ord)
          @php
          $i++;
          @endphp
          <tr>
            <td><i>{{$i}}</i></label></td>
            <td>{{$ord->order_code}}</td>
            <td>
                @if($ord->order_status==1)
                Đơn hàng mới
                @else
                Đã xử lý
                @endif
                                      

            </td>

            <td>
              <a href="{{URL::to('/view-order/'.$ord->order_code)}}" class="active style-edit" ui-toggle-class="">
                <i class="fa fa-eye text-success text-active"></i>
              </a>
              <a onclick="return confirm('Bạn có muốn xóa danh mục ???')" href="{{URL::to('/delete-order/'.$ord->order_code)}}" class="active style-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection