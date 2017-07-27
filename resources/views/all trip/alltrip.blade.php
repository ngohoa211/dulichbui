@extends('layouts.app') 
@section('content')
<div class="container">
        <div id="content" class="space-top-none">
            <div class="main-content">
                <div class="space60">&nbsp;</div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="beta-products-list">
                             <h3>All Trip</h3>
                            <div class="beta-products-details">
                                <div class="clearfix"></div>
                            </div>

                        <!--  cái cậu cần thêm ở đây; -->
                            <div class="row">
                            @foreach ($trips as $trip)
                                <div class="col-sm-3">
                                    <div class="single-item">
                                        <div class="single-item-header">                                        
                                            <a href="#"><img src="{{$trip->coverimg}}" alt="" width="270" height="320" ></a>
                                        </div>
                                        <div class="single-item-body">
                                            <p>{{$trip->name}}</p>
                                        </div>
                                        <div class="single-item-caption">
                                            
                                            <a class="beta-btn primary" href="#">Details <i class="fa fa-chevron-right"></i></a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>

                        </div> <!-- .beta-trips-list -->
                    </div>
                </div> <!-- end section with sidebar and main content -->


            </div> <!-- .main-content -->
        </div> <!-- #content -->
    </div> <!-- .container -->

                            
@stop