@extends('layouts.app')
@section('content').
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="{{asset('js/trips/parts/add_part.js')}}" ></script>
<div class="container">
	<div id="content" class="space-top-none">
		<div class="main-content">
			<div class="space60">&nbsp;</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="beta-products-list">
						<div class="beta-products-list">
						<h3> Create New Trip</h3>
						<div class="beta-products-details">
							<div class="clearfix"></div>
						</div>
						<div class="row">
							<form action="#" method="post" class="form-horizontal">
								{{ csrf_field() }}								
								<div class="col-sm-6">
									<h4></h4>
									<div class="space20">&nbsp;</div>
									
									<div id = "tripinfo">
									<div class="space20">&nbsp;</div>
									
			


										

										<div class="form-group">
											<!-- <label class="control-label col-sm-2" >vị trí</label>
											<div class="col-sm-7">
												
											</div> -->
										</div>
										
										
									</div>
									<div class="form-group"> 
										<div class="col-sm-offset-2 col-sm-10">
											<button type="submit" class="btn btn-default" onclick="c_mapping.prepare()">Create</button>
											<button type="reset" class="btn btn-default">Cancel</button>
										</div>
									</div> 
								</div>
							</form>            
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
							<br>
							
						</div>
					</div>
					</div>
				</div> 

			</div> 
		</div> 
	</div> 
</div>


@stop