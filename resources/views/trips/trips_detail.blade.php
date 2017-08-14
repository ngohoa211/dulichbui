@extends('layouts.app')
@section('content')

<script type="text/javascript" src="{{asset('js/jquery-3.2.1.min.js')}}" ></script>
<script type="text/javascript" src="{{asset('js/trips/parts/add_part.js')}}" ></script>
<div class="container">
	<div id="content" class="space-top-none">
		<div class="main-content">
			<div class="space60">&nbsp;</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="beta-products-list">
					<div class="row">
						<div class="col-sm-1">
							<div class="dropdown">
							  <button class="btn btn-basic dropdown-toggle" type="button" data-toggle="dropdown">Xem...
							  <span class="caret"></span></button>
							  <ul class="dropdown-menu">
							    <li><a href="{{url('/trip_home/plan/'.$trip->id)}}">Kế Hoạch</a></li>
							    <li><a href="{{route('get.comment',$trip->id)}}">Comment</a></li>
							    <li><a href="{{route('show_member',$trip->id)}}">Danh sách thành viên</a></li>
							  </ul>
							</div>
						</div>
						@if(Auth::check())
							@if(in_array("watch",$permission))
								@if( (in_array("folowed",$permission)==false))
								<div class="col-sm-1">
									<button type="button" class="btn btn-success">
										<a href="{{url('/trip_home/addFolow/'.$trip->id)}}" style="color: black">Follow</a>
									</button>
								</div>
								@endif
								@if((in_array("owner",$permission)==false) 
									AND (in_array("joined",$permission)==false) 
									AND (in_array("waitting",$permission)==false))
								<div class="col-sm-1">
									<button type="button" class="btn btn-success">
									<a href="{{url('/trip_home/add_request_join/'.$trip->id)}}" style="color: black">Join in</a>
									</button>
								</div>
								@endif
							@endif
							@if(in_array("joined",$permission))
							<div class="col-sm-1">
								<button type="button" class="btn btn-success">
								<a href="{{url('/trip_home/quit_trip/'.$trip->id)}}" style="color: black">Quit</a>
								</button>
							</div>
							@endif
							@if(in_array("waitting",$permission))
							<div class="col-sm-2">
								<button type="button" class="btn btn-success">
								<a href="{{url('/trip_home/delete_request_join/'.$trip->id)}}" style="color: black">Cancel request join in</a>
								</button>
							</div>
							@endif
							@if(in_array("folowed",$permission))
							<div class="col-sm-1">
								<button type="button" class="btn btn-success">
								<a href="{{url('/trip_home/deleteFollow/'.$trip->id)}}" style="color: black">Unfolow</a>
								</button>
							</div>
							@endif
							@if(in_array("owner",$permission))
							<div class="col-sm-1">
								<button type="button" class="btn btn-success">
								<a href="{{route('edit_trip_plan',$trip->id)}}" style="color: black">Edit</a>
								</button>
							</div>
							<div class="col-sm-3">
								<h5>(Chuyến này do bạn quản lý)</h5>
							</div>
							@endif
						@endif
						
						

					</div>
						
						
						   		
						
						<div class="beta-products-details">
							<h3>Kế hoạch</h3>
							<div class="clearfix"></div>
							<form  id="usrform" class="form-horizontal">
								{{ csrf_field() }}
								<div class="row">								
								<div class="col-sm-6">
									<h4></h4>
									<div class="space20">&nbsp;</div>
									<div class="form-group">
										<label class="control-label col-sm-2" >Name trip</label>
										<div class="col-sm-7">
											<input class="form-control" name="name" value="{{$trip->name}}" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2" >Địa điểm tập trung</label>
										<div class="col-sm-7">
											<input  class="form-control" name="place_gather" value="{{$trip->place_gather}}" readonly />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2" >Thời gian khởi hành</label>
										<div class="col-sm-7">
											<input type="datetime-local" class="form-control" name="start_date" 
											value="{{date('Y-m-d\TH:i', strtotime($trip->start_date))}}" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2" >Thời gian kết thúc:</label>
										<div class="col-sm-7">
											<input type="datetime-local" class="form-control" name="end_date" 
											value="{{date('Y-m-d\TH:i', strtotime($trip->end_date))}}" readonly/>
										</div>
									</div>
									
								</div>
								<div class="col-sm-6">
								<div class="your-order">
									<div class="your-order-head"><h4>Ảnh bìa</h4></div>
									<div class="your-order-body" style="padding: 0px 10px">
										<div class="your-order-item">
											<div class="clearfix"></div>
										</div>
										<div class="your-order-item">

											<img src="{{asset($trip->url)}}" alt="" width="270" height="320" >

										</div>
									</div>
								</div>
								</div>
								</div>
								<hr>
								<hr>
								<div class="row">
								<div class="col-sm-6">
									<h4>Các chặng</h4>
									<div class="space20">&nbsp;</div>
									
									<div id = "tripinfo">
									<div class="space20">&nbsp;</div>
										@foreach($trip->parts as $part)
										<div id ="'block'{{$part->status}}" class="mypart">
										<h5> Chặng {{$part->status+1}}</h5>
										<div class="form-group" >
											 <label class="control-label col-sm-3" >Vị trí</label>
											<div class="col-sm-9">
												<input  class="form-control" id="vitri" value="{{$part->name}}" readonly >
											</div>
										</div>
										<div class="form-group" >
											<label class="control-label col-sm-3" >Đi đến bằng:</label>
											<div class="col-sm-6">
												<input  class="form-control" id ="moveby" value="{{$part->move_by}}" readonly>
											</div>
										</div>
										<div class="form-group" >
												<label class="control-label col-sm-3" >Đến nơi vào lúc:</label>
												<div class="col-sm-6">
													<input type="datetime-local" class="form-control" id="start_date" 
													value="{{date('Y-m-d\TH:i', strtotime($part->start_date))}}" readonly>
												</div>
										</div>
										<div class="form-group" >
											<label class="control-label col-sm-3" >Rời đi vào lúc:</label>
												<div class="col-sm-6">
													<input type="datetime-local" class="form-control" id ="end_date" 
													value="{{date('Y-m-d\TH:i', strtotime($part->end_date))}}" readonly>'
												</div>
										</div>

										<div class="form-group" >
										<label class="control-label col-sm-3" >Hoạt động</label>
												@if($part->activiti!=null)
												<div class="col-sm-9">'
													<textarea readonly rows="4" cols="50" id="activiti" form="usrform" 
													 style="height: 136px">{{$part->activiti}}</textarea>
												</div>
												@else

												@endif
										</div>
										<div class="form-group">
    											<input type="hidden" class="form-control" id="latitude" 
    											value="{{$part->latitude}}" readonly>
  										</div>
  										<div class="form-group">'
    											<input type="hidden" class="form-control" id="longtitude" 
    											value="{{$part->longitude}}" readonly>
  										</div>
										</div>
										@endforeach
									</div>
									
								</div>
							            
							<div class="col-sm-6">
								<div class="your-order">
									<div class="your-order-head"><h5>Map</h5></div>
									<div class="your-order-body" style="padding: 0px 10px">
										<div class="your-order-item">
											<div class="clearfix"></div>
										</div>
										<div class="your-order-item" id="map_canvas" style="height:400px;" >
											<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiIN-tURp9PZIjXVEuB5dCdmo-iIrh2SM&callback=initMap">
 											</script>

										</div>
									</div>
								</div>
							</div>
							</div>
							<hr><hr>
								<div class="form-group"> 
								</div> 
							</form>            
							
							<br>

					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->
</div>

<script type="text/javascript">
	$( document ).ready(function() {
	//sau khi tai xong. thuc hien: ve route

		$('.mypart').each(function() {
			v_map.marker = new google.maps.Marker({ 
			position: {
				lat: parseFloat($(this).find('#latitude').val()),
				lng: parseFloat($(this).find('#longtitude').val())}, 
			map: v_map.map,
			});
			var m_pb = new m_ptbl(v_map.marker,$(this));
			m_arrayPoint.push(m_pb);
		});
    	v_map.displayAllRoute(m_arrayPoint);
	});
</script>

@stop
