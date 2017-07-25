@extends('layouts.app')
@section('content')
<div class="row carousel-holder">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Thông tin cá nhân</h4></div>
                    <div class="panel-body">
                        <form>
                           <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                       
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>{{$profile->name}}</td>
                            </tr>
                            <tr>
                                <td>E-Mail Address</td>
                                <td>{{$profile->email}}</td>
                            </tr>
                            <tr>
                                <td>Age</td>
                                <td>{{$profile->age}}</td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>{{$profile->gender}}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{$profile->address}}</td>
                            </tr>

                        </tbody>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
  
@stop