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
            
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          
          <tr>
            <td>{{$prescription_by_id->customer_name}}</td>
            <td>{{$prescription_by_id->customer_phone}}</td>
            
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
      CHI TIẾT TOA THUỐC 
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
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          
          <tr>

            <td><img src="{{URL::to('public/uploads/prescription/'.$prescription_by_id->prescription_image)}}" height="600" width="600"></td>
            <td>{{$prescription_by_id->prescription_desc}}</td>

          </tr>
          
        </tbody>
      </table>
    </div>
    
  </div>
</div>

@endsection