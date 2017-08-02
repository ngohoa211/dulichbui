@extends('layouts.app')

<!-- Comments Form -->
@section('content')
<div class="container">

    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;</div>
            <div class="well">
        
                <h4>Comment ...<span class="glyphicon glyphicon-pencil"></span></h4>
                <form action="{{ route('post.comment', 1) }}" method="POST" role="form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <div class="form-group">
                        <textarea class="form-control" name="content" rows="1"></textarea>
                    </div>
                    

                    <div class="form-group">
                        <label>Images</label>
                        <input type="file" name="fImages">
                    </div>

                    <button type="submit" class="btn btn-primary">Gửi</button>
                </form>
            </div> 
             <hr>
                 
             @foreach($comment as $value)
             <tr class="odd gradeX" align="center">
                 <p> <td>{{$value->user->name}}</td></p>
                 <td>{{$value->content}}</td>
                 <td>{{$value->created_at}}</td>

             </tr>
             @endforeach
        </div>
    </div>
</div>

<!-- Posted Comments -->
@stop