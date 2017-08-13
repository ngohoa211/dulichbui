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
						<h3> Sửa kế hoạch</h3>
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
							<form action="{{route('do_edit_trip_plan',$trip->id)}}" method="post" class="form-horizontal" 
							id="usrform" enctype="multipart/form-data" file="true" >
								{{ csrf_field() }}
								<div class="row">								
								<div class="col-sm-6">
									<h4></h4>
									<div class="space20">&nbsp;</div>
									<div class="form-group">
										<label class="control-label col-sm-2" >Name trip</label>
										<div class="col-sm-7">
											<input class="form-control" name="name" value="{{$trip->name}}"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2" >Địa điểm tập trung</label>
										<div class="col-sm-7">
											<input  class="form-control" name="place_gather" value="{{$trip->place_gather}}"  />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2" >Thời gian khởi hành</label>
										<div class="col-sm-7">
											<input type="datetime-local" class="form-control" name="start_date" 
											value="{{date('Y-m-d\TH:i', strtotime($trip->start_date))}}" />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2" >Thời gian kết thúc:</label>
										<div class="col-sm-7">
											<input type="datetime-local" class="form-control" name="end_date" 
											value="{{date('Y-m-d\TH:i', strtotime($trip->end_date))}}" />
										</div>
									</div>
								</div>

								<div class="col-sm-6">
								<div class="your-order">
									<div class="your-order-head"><h5>Ảnh bìa</h5></div>
									<div class="your-order-body" style="padding: 0px 10px">
										<div class="your-order-item">
											<div class="clearfix"></div>
										<div class="your-order-item">

											<img src="{{asset($trip->url)}}" alt="" width="270" height="320" >

										</div>
										</div>
										<br>
										<hr>
										<div class="your-order-item">
											<div class="form-group">
												<label class="control-label col-sm-3" >Chọn ảnh khác :</label>
												<div class="col-sm-7">
													<input type="file" name="cover" />
												</div>
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
										@foreach($trip->parts as $part)
										<div id ="block{{$part->status}}" class="mypart">
										<div class="form-group" >
											 <label class="control-label col-sm-3" >Vị trí</label>
											<div class="col-sm-9">
												<input  class="form-control" id="vitri" value="{{$part->name}}"  readonly />
											</div>
										</div>
										<div class="form-group" >
											<label class="control-label col-sm-3" >Đi đến bằng:</label>
											<div class="col-sm-6">
												<input  class="form-control" id ="moveby" value="{{$part->move_by}}" >
											</div>
										</div>
										<div class="form-group" >
												<label class="control-label col-sm-3" >Đến nơi vào lúc:</label>
												<div class="col-sm-6">
													<input type="datetime-local" class="form-control" id="start_date" 
													value="{{date('Y-m-d\TH:i', strtotime($part->start_date))}}" >
												</div>
										</div>
										<div class="form-group" >
											<label class="control-label col-sm-3" >Rời đi vào lúc:</label>
												<div class="col-sm-6">
													<input type="datetime-local" class="form-control" id ="end_date" 
													value="{{date('Y-m-d\TH:i', strtotime($part->end_date))}}" >'
												</div>
										</div>

										<div class="form-group" >
										<label class="control-label col-sm-3" >Hoạt động</label>
												@if($part->activiti!=null)
												<div class="col-sm-9">'
													<textarea  rows="4" cols="50" id="activiti" form="usrform" 
													 style="height: 136px">{{$part->activiti}}</textarea>
												</div>
												@else
												<div class="col-sm-9">
												<button type="button" class="btn btn-default" aria-label="Left Align" id="addhd">'
						  							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>'
												</button>'
												</div>'
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
										<div class="col-sm-offset-2 col-sm-10">
											<button type="submit" class="btn btn-default" onclick="c_mapping.prepare()">Edit</button>
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
<script type="text/javascript">
	$( document ).ready(function() {
	//sau khi tai xong. thuc hien:
	//add button 
	c_mapping.numbers_block=$('#tripinfo').children().length-2;
	c_mapping.buttonId_number_current=1;
	$('#tripinfo').append(v_button_add.addButton(c_mapping.buttonId_number_current));
	c_mapping.buttonId_number_current=c_mapping.numbers_button;
	c_mapping.button_type = 'add';
	//add su kien click vao button
	c_event.addClickEventForButtonAdd($('#button'+c_mapping.buttonId_number_current));
	//
	$('.mypart').each(function() {
			v_map.marker = new google.maps.Marker({ 
			position: {
				lat: parseFloat($(this).find('#latitude').val()),
				lng: parseFloat($(this).find('#longtitude').val())}, 
			map: v_map.map,
			});
			var m_pb = new m_ptbl(v_map.marker,$(this));
			m_arrayPoint.push(m_pb);

			$(this).prepend('<button type="button"  class="btn btn-warning" id="delete" >xóa điểm</button>');
			 c_event.addClickEventForButtonDelete($(this).find("#delete"));
			 c_event.addClickEventForButtonPlush($(this).find("#addhd"));
		});
		if(m_arrayPoint.length!=0)
		v_map.displayAllRoute(m_arrayPoint);
		
	});
</script>

@stop


								
								<!-- <div class="col-sm-6">
									<h4>Các chặng</h4>
									<div class="space20">&nbsp;</div>
									
									<div id = "tripinfo">
									
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
							</form>  -->