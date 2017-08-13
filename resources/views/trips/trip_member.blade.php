@extends('layouts.app')
@section('content')
<div class="container">
	<div id="content" class="space-top-none">
		<div class="main-content">
			<div class="space60">&nbsp;</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="beta-products-list">
						<div class="dropdown">
						  <button class="btn btn-basic dropdown-toggle" type="button" data-toggle="dropdown">Xem...
						  <span class="caret"></span></button>
						  <ul class="dropdown-menu">
						    <li><a href="{{url('/trip_home/plan/'.$trip_id)}}">Kế Hoạch</a></li>
						    <li><a href="{{route('get.comment',$trip_id)}}">Comment</a></li>
						    <li><a href="{{route('show_member',$trip_id)}}">Danh sách thành viên</a></li>
						   
						  </ul>
						</div>
						
						<div class="beta-products-details">
							<h3>Danh sách thành viên</h3>

							<div class="clearfix"></div>
							@if($owner==null)
							<h4>Chuyến đi hiện không có ai quản lý</h4>
							@else
							<h4>Chuyến đi này do {{$owner->name}} quản lý, liên hệ : {{$owner->email}}</h4>
							@endif
							<h5>các thành viên khác trong chuyến đi</h5>
							<table class="table">
							    <thead>
							      <tr>
							        <th>Họ tên</th>
							        <th>Tuổi</th>
							        <th>Giới tính</th>
							        <th>Địa chỉ</th>
							        <th>Email</th>
							        <th>Ngày vào</th>
							        @if(in_array("owner",$permission))
							        <th class="col-md-2" >Delete</th>
							        @endif
							      </tr>
							    </thead>
							    <tbody>
							    @foreach ($joiners as $joiner)
							      <tr>
							        <td>{{$joiner->name}}</td>
							        <th>{{$joiner->age}}</th>
							        <th>{{$joiner->gender}}</th>
							        <th>{{$joiner->address}}</th>
							        <th>{{$joiner->email}}</th>
							        <td>{{$joiner->time_in}}</td>
							        @if(in_array("owner",$permission))
							        <td><a href="{{url('/trip_home/list_member/delete_member/'.$trip_id.'/'.$joiner->id)}}">Delete</a></td>
							         @endif
							      </tr>
							      @endforeach
							    </tbody>
							  </table>
							<hr>
							<br>
							<h5>các thành viên đang xin vào</h5>
							<table class="table">
							    <thead>
							      <tr>
							        <th>Họ tên</th>
							        <th>Tuổi</th>
							        <th>Giới tính</th>
							        <th>Địa chỉ</th>
							        <th>Email</th>
							        <th>Ngày gửi đăng kí</th>
							        @if(in_array("owner",$permission))
							        <th>Delete</th>
							        <th>Accept</th>
							        @endif
							      </tr>
							    </thead>
							    <tbody>
							    @foreach ($watingers as $watinger)
							      <tr>
							        <td>{{$watinger->name}}</td>
							        <th>{{$watinger->age}}</th>
							        <th>{{$watinger->gender}}</th>
							        <th>{{$watinger->address}}</th>
							        <th>{{$watinger->email}}</th>
							        <td>{{$watinger->time_request}}</td>
							        @if(in_array("owner",$permission))
							        <td class="col-md-1"><a href="{{url('/trip_home/list_member/delete_request/'.$trip_id.'/'.$watinger->id)}}">Delete</a></td>
							        <td class="col-md-1"><a href="{{url('/trip_home/list_member/add_mem/'.$trip_id.'/'.$watinger->id)}}">Accept</a></td>
							         @endif
							      </tr>
							      @endforeach
							    </tbody>
							  </table>
						</div>


					</div>
				</div> <!-- end section with sidebar and main content -->
			

			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->
</div>


@stop
