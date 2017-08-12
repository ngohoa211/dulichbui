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
							    <li><a href="{{url('/trip_home/plan/'.$trip_id)}}">Kế Hoạch</a></li>
							    <li><a href="{{route('get.comment',$trip_id)}}">Comment</a></li>
							    <li><a href="{{route('show_member',$trip_id)}}">Danh sách thành viên</a></li>
							  </ul>
							</div>
						</div>
						@if(Auth::check())
							@if(in_array("watch",$permission))
								@if( (in_array("folowed",$permission)==false))
								<div class="col-sm-1">
									<button type="button" class="btn btn-success">
										<a href="{{url('/trip_home/addFolow/'.$trip_id.'/'.Auth::user()->id)}}" style="color: black">Follow</a>
									</button>
								</div>
								@endif
								@if((in_array("owner",$permission)==false) 
									AND (in_array("joined",$permission)==false) 
									AND (in_array("waitting",$permission)==false))
								<div class="col-sm-1">
									<button type="button" class="btn btn-success">
									<a href="{{url('/trip_home/add_request_join/'.$trip_id)}}" style="color: black">Join in</a>
									</button>
								</div>
								@endif
							@endif
							@if(in_array("joined",$permission))
							<div class="col-sm-1">
								<button type="button" class="btn btn-success">
								<a href="{{url('/trip_home/quit_trip/'.$trip_id)}}" style="color: black">Quit</a>
								</button>
							</div>
							@endif
							@if(in_array("waitting",$permission))
							<div class="col-sm-2">
								<button type="button" class="btn btn-success">
								<a href="{{url('/trip_home/delete_request_join/'.$trip_id)}}" style="color: black">Cancel request join in</a>
								</button>
							</div>
							@endif
							@if(in_array("folowed",$permission))
							<div class="col-sm-1">
								<button type="button" class="btn btn-success">
								<a href="{{url('/trip_home/deleteFollow/'.$trip_id)}}" style="color: black">Unfolow</a>
								</button>
							</div>
							@endif
							@if(in_array("owner",$permission))
							<div class="col-sm-3">
								<h5>(Chuyến này do bạn quản lý)</h5>
							</div>
							@endif
						@endif
						
						

					</div>
						
						
						   		
						
						<div class="beta-products-details">
							<h3>Kế hoạch</h3>
							<div class="clearfix"></div>
							<form action="{{route('create_new_trip')}}" method="get" class="form-horizontal" id="usrform">
								{{ csrf_field() }}
								<div class="row">								
								<div class="col-sm-6">
									<h4></h4>
									<div class="space20">&nbsp;</div>
									<div class="form-group">
										<label class="control-label col-sm-2" >Name trip</label>
										<div class="col-sm-7">
											<input class="form-control" name="name" value="" />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2" >Địa điểm tập trung</label>
										<div class="col-sm-7">
											<input  class="form-control" name="place_gather" >
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2" >Thời gian khởi hành</label>
										<div class="col-sm-7">
											<input type="datetime-local" class="form-control" name="start_date" />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2" >Thời gian kết thúc:</label>
										<div class="col-sm-7">
											<input type="datetime-local" class="form-control" name="end_date" />
										</div>
									</div>
									
								</div>
								<div class="col-sm-6">
								<div class="your-order">
									<div class="your-order-head"><h5>cover</h5></div>
									<div class="your-order-body" style="padding: 0px 10px">
										<div class="your-order-item">
											<div class="clearfix"></div>
										</div>
										<div class="your-order-item">

											cover img

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

										<div class="form-group">
											<!-- <label class="control-label col-sm-2" >vị trí</label>
											<div class="col-sm-7">
												
											</div> -->
										</div>
										
										
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
										<div class="col-sm-offset-2 col-sm-10">
											<button type="submit" class="btn btn-default" onclick="c_mapping.prepare()">Create</button>
											<button type="reset" class="btn btn-default">Cancel</button>
										</div>
									</div> 
							</form>            
							
							<br>

					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->
</div>


@stop
