@extends('layouts.app')
@section('content')
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
						<div class="row">
							<form action="#" method="post" class="form-horizontal">
								{{ csrf_field() }}								
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
											<input type="timestamp" class="form-control" name="start_date" />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2" >Thời gian kết thúc:</label>
										<div class="col-sm-7">
											<input type="timestamp" class="form-control" name="end_date" />
										</div>
									</div>
									<div class="form-group"> 
										<div class="col-sm-offset-2 col-sm-10">
											<button type="submit" class="btn btn-default">Create</button>
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
										<div class="your-order-item">

											bản đồ c làm trong này

										</div>
									</div>
								</div>
							</div>
							<br>
							<table class="table table-striped table-bordered table-hover" id="dataTables-example">
								<thead>
									<tr align="center">
										<th>Điểm bắt đầu</th>
										<th>Điểm kết thúc</th>
										<th>start time</th>
										<th>end time</th>
										<th>Phương tiện</th>
										<th>Hoạt động</th>
										<th><a href="{{route('add_part')}}">Add</a></th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->
</div>


@stop
