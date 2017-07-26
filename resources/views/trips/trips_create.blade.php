@extends('layouts.app')

@section('content')

    
	<div class="container">
		<div id="content">

			<form action="#" method="post" class="form-horizontal">
                        {{ csrf_field() }}

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
                </form>            
					<div class="col-sm-6">
						<div class="your-order">
							<div class="your-order-head"><h5>Map</h5></div>
							<div class="your-order-body" style="padding: 0px 10px">
								<div class="your-order-item">
									<div>
									<!--  one item	 -->
										<div class="media">
											<img src="assets/dest/images/shoping1.jpg" alt="" class="pull-left">
										</div>
									<!-- end one item -->
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="your-order-item">
									<div class="pull-left"><p class="your-order-f18"></p></div>
									<div class="pull-right"><h5 class="color-black"></h5></div>
									<div class="clearfix"></div>
								</div>
							</div>
					</div>
		</div> <!-- #content -->
	</div> <!-- .container -->
@stop
