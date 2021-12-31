@extends('layout')

@section('content')
<table class="table table-striped b-t b-light">
        <thead>
          <tr>
            
            <th style="width:50px;"></th>
          </tr>
        </thead>
        <tbody>
          
          <tr>

            <td><div id="map" style="width:600px;height:600px;"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.849054307829!2d106.68418841474865!3d10.746114492342114!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752fa820c44627%3A0x53ef4d600d08d9eb!2zMTI5IE5ndXnhu4VuIFRo4buLIFThuqduLCBQaMaw4budbmcgMiwgUXXhuq1uIDgsIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1607976689254!5m2!1svi!2s" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></div></td>
            <td><h1><a href="{{URL::to('/chinhanh-1')}}">Chi nhánh 1</a></h1> 1 Lô 15 Phạm Thế Hiển, Phường 4, Quận 8, TPHCM<br>
              <h1><a href="{{URL::to('/chinhanh-2')}}">Chi nhánh 2</a></h1> 129 Nguyễn Thị Tần, Phường 2, Quận 8, TPHCM<br>
              <h1><a href="{{URL::to('/chinhanh-3')}}">Chi nhánh 3</a></h1> 116 Nguyễn Thị Tần, Phường 2, Quận 8, TPHCM<br>
              <h1><a href="{{URL::to('/chinhanh-4')}}">Chi nhánh 4</a></h1> 546 Tạ Quang Bửu, Phường 6, Quận 8, TPHCM</td>

          </tr>
          
            
         
      
          
        </tbody>
      </table>
@endsection
