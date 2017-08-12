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
						<h3> Create New Trip</h3>
						<div class="beta-products-details">
							<div class="clearfix"></div>
						</div>
						@if(count($errors))
							<div class="alert alert-danger">
								<strong>Whoops!</strong> There were some problems with your input.
								<br/>
								<ul>
									@foreach($errors->all() as $error)
									<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
							<form action="{{route('create_new_trip')}}" method="post" class="form-horizontal" 
							id="usrform" enctype="multipart/form-data" file="true" >
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
									<div class="form-group" >
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
											<div class="form-group">
												<input type="file" name="cover" />
											</div>
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
