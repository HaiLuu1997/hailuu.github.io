@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LIỆT KÊ TOA THUỐC
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-3">
      </div>
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
            <th>SDT</th>
            <th>Toa thuốc</th>
            <th>Ghi chú</th>
            <th>Hiển thị</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_prescription as $key => $pres)
          <tr>
            <td>{{$pres->customer_name}}</td>
            <td>{{$pres->customer_phone}}</td>
            <td><img src="public/uploads/prescription/{{$pres->prescription_image}}" height="100" width="100"></td>
            <td>{{$pres->prescription_desc}}</td>
            
            <td>
              <a href="{{URL::to('/view-prescription/'.$pres->prescription_id)}}" class="active style-edit" ui-toggle-class="">
                <i class="fa fa-eye text-success text-active"></i>
              </a>
              <a onclick="return confirm('Bạn có muốn xóa đơn hàng ???')" href="{{URL::to('/delete-prescription/'.$pres->prescription_id)}}" class="active style-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection