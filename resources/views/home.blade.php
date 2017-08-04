@extends('layouts.app')
@section('title', 'home')
@section('content')
    <div class="container">
        <div id="content" class="space-top-none">
            <div class="main-content">
                <div class="space60">&nbsp;</div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="beta-products-list">
                             <h3>New Trip</h3>
                            <div class="beta-products-details">
                                <div class="clearfix"></div>
                            </div>

                            <div class="row">
                            @foreach ($new_trips as $new_trip)
                                <div class="col-sm-3">
                                    <div class="single-item">
                                        <div class="single-item-header">                                        
                                            <a href="#"><img src="{{$new_trip->coverimg}}" alt="" width="270" height="320" ></a>
                                        </div>
                                        <div class="single-item-body">
                                            <p>{{$new_trip->name}}</p>
                                        </div>
                                        <div class="single-item-caption">
                                            
                                            <a class="beta-btn primary" href="#">Details <i class="fa fa-chevron-right"></i></a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                            </div>
                            <div class="row">
                                {!! $new_trips->links() !!}  

                            </div>
                        
                        </div> <!-- .beta-trips-list -->

                        <div class="space50">&nbsp;</div>

                        <div class="beta-products-list">
                            <h3 class="me">Hot Trip</h3>
                            <div class="beta-products-details">
                                <div class="clearfix"></div>
                            </div>

                        <div class="row">
                            @foreach ($hot_trips as $hot_trip)
                                <div class="col-sm-3">
                                    <div class="single-item">
                                        <div class="single-item-header">  

                                            <a href="#"><img src="{{$hot_trip->coverimg}}" alt="" width="270" height="320" ></a>
                                        </div>
                                        <div class="single-item-body">
                                            <p>{{$hot_trip->name}}</p>
                                        </div>
                                        <div class="single-item-caption">
                                            
                                            <a class="beta-btn primary" href="#">Details <i class="fa fa-chevron-right"></i></a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                        </div>
                        <div class="row">
                            {!! $hot_trips->links() !!}  
                         </div>

                        </div> <!-- .beta-trips-list -->
                    </div>
                </div> <!-- end section with sidebar and main content -->


            </div> <!-- .main-content -->
        </div> <!-- #content -->
    </div> <!-- .container -->

    
</body>
</html>
@endsection
