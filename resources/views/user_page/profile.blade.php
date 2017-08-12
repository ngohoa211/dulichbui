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
                </table>
                 <a href="javascript:void(0)" class="edit-a" ><h4>Edit</h4></a><br>
            </form> 
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
        </div>
        <div>
        <hr>
        
            <form action="{{route('post.edit.profile')}}" method="POST" role="form" class="edit-form" style=" display: none;">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                 <h4>Edit profile</h4>
                <div class="form-group">
                    <label class="control-label col-sm-3" >Name:</label>
                    <div class="col-sm-7">
                        <input class="form-control"  placeholder="username" name="name" value="{{$profile->name}}" />
                    </div>
                </div><br>
               <div class="form-group">
                    <label class="control-label col-sm-3" >Old Password:</label>
                    <div class="col-sm-7">
                       <input type="password" class="form-control" name="password" placeholder="Enter your password" >
                   </div>
               </div><br>
               <div class="form-group">
                    <label class="control-label col-sm-3" >New Password:</label>
                    <div class="col-sm-7">
                       <input type="password" class="form-control" name="newpass" placeholder="Enter new password" >
                   </div>
               </div><br>
               <div class="form-group">
                    <label class="control-label col-sm-3" >Confirm new password:</label>
                    <div class="col-sm-7">
                       <input type="password" class="form-control" name="confirm_newpass" placeholder="Confirm new password" >
                   </div>
               </div><br>
               <div class="form-group">
                 <label class="control-label col-sm-3">Age:</label>
                 <div class="col-sm-7">
                    <input class="form-control" placeholder="age" name="age" value="{{$profile->age}}" />
                </div>
               </div><br>
               <div class="form-group">
                 <label  class="control-label col-sm-3" >Gender:</label>
                 <div class="col-sm-7">
                    <input class="form-control" placeholder="gender" name="gender" value="{{$profile->gender}}" />
                </div>
               </div><br>
               <div class="form-group">
                 <label class="control-label col-sm-3">Address:</label>
                 <div class="col-sm-7">
                    <input class="form-control" placeholder="address" name="address" value="{{$profile->address}}" />
                </div>
               </div><br>
               <div class="form-group"> 
                <div class="col-sm-offset-3 col-sm-10">
                <button type="submit" class="btn btn-primary" >Edit</button>
                    <button type="reset" class="btn btn-default">Cancel</button>
                </div>
            </div> 
        </form>
        </div>
</div>
</div>
</div>
@stop
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
         
         $(".edit-a").click(function(){
            $(".edit-form").slideToggle();
        });
        });
</script>