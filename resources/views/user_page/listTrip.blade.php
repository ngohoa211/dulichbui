	@extends('layouts.app')

	@section('content')

	<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="beta-products-list">
							@if($list=='list is empty')
							<h3> List is empty </h3>
							@else
							<h3> {{$name_page}} </h3>
							<table class="table">
							    <thead>
							      <tr>
							        <th>Tên</th>
							        <th>Khởi hành dự kiến</th>
				                    <th>Kết thúc dự kiến</th>
				                    <th>Điểm tập trung</th>
							        <th>Ngày tạo</th>
							        <th>Ngày cập nhật</th>
				                    <th>delete</th>
							      </tr>
							    </thead>
							    <tbody>
							    @foreach($list as $trip)
							      <tr>
							        <td>{{$trip->name}}</td>
							        <td>{{$trip->start_date}}</td>
							        <td>{{$trip->end_date}}</td>
							        <td>{{$trip->place_gather}}</td>
							        <td>{{$trip->created_at}}</td>
							        <td>{{$trip->updated_at}}</td>
							        <td><a>delete</a></td>				
							      </tr>
							 	@endforeach
							    </tbody>
							  </table>
							
							@endif
						</div>
					</div> 

				</div> 
			</div> 
		</div> 
	</div>
	  
	@stop