@extends('layouts.app')
@section('content')
     <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
      
                                <th>name </th>
                                <th>email</th>
                                <th>age</th>
                                <th>gender</th>
                                <th>address</th>
                            </tr>
                        </thead>
   <tbody>
                                <tr class="odd gradeX" align="center">
                                    <td>{{$profile->name}}</td>
                                    <td>{{$profile->email}}</td>
                                    <td>{{$profile->age}}</td>
                                    <td>{{$profile->gender}}</td>
                                    <td>{{$profile->address}}</td>
                                    
                                </tr>
                           
                        </tbody>
  
@stop