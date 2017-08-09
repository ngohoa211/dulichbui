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
						    <li><a href="/trip_home/plan/{{$trip_id}}">Kế Hoạch</a></li>
						    <li><a href="/trip_home/comment/{{$trip_id}}">Comment</a></li>
						    <li><a href="{{route('show_member',$trip_id)}}">Danh sách thành viên</a></li>
						   
						  </ul>
						</div>
						
						<div class="beta-products-details">
							<h3>Danh sách thành viên</h3>
							<div class="clearfix"></div>
							<h5>các thành viên trong chuyến đi</h5>
							<table class="table">
							    <thead>
							      <tr>
							        <th>Họ tên</th>
							        <th>Ngày vào</th>
							        @if($permission =='owner')
							        <th>Delete</th>
							        @endif
							      </tr>
							    </thead>
							    <tbody>
							    @foreach ($joiners as $joiner)
							      <tr>
							        <td>{{$joiner->name}}</td>
							        <td>{{$joiner->time_in}}</td>
							        @if($permission =='owner')
							        <td><a href="#">Delete</a></td>
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
							        <th>Ngày gửi đăng kí</th>
							        @if($permission =='owner')
							        <th>Delete</th>
							        <th>Accept</th>
							        @endif
							      </tr>
							    </thead>
							    <tbody>
							    @foreach ($watingers as $watinger)
							      <tr>
							        <td>{{$watinger->name}}</td>
							        <td>{{$watinger->time_in}}</td>
							        @if($permission =='owner')
							        <td><a href="#">Delete</a></td>
							        <td><a href="#">Accept</a></td>
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
