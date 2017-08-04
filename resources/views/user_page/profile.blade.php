@extends('layouts.app')
@section('content')
<div class="container">

    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;</div>
            <div class="well"><span style="text-align: center"><h4><b>Thông tin cá nhân</b></h4></span>

                <form role="form">
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
    
</div>

@stop