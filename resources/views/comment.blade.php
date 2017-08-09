@extends('layouts.app')

@section('title', 'comment')

@section('style_css')
<link rel="stylesheet" title="style" href="{{asset('source/assets/dest/css/comment.css')}}">
@endsection
@section('content')
<div class="container">
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;</div>
            <!--  show comment  -->
            @foreach($comment as $value)
            @if($value->father_id == 0)
            <form role="form">
                <div class="com-form">
                 <img src="{{asset('source/assets/dest/images/default_avatar.png')}}" alt="" width="40" height="40" >
                 <span style="color: blue"><b>{{$value->user->name}}</b>&nbsp;</span>
                 <small> {{$value->created_at}} </small>&nbsp; <a href="javascript:void(0)" class="rep-a" data-a={{$value->id }}>Reply</a><br>
                 {{$value->content}} 
                 <br>
                 @foreach( $value->imgs as $this_comment_img)
                 <img src="{{asset($this_comment_img->url)}}" width="200" height="200">
                 @endforeach
             </div>    
         </form>
        
      <!--   Reply comment Form -->
         <form action="{{url('/rep_comment/'.$trip_id.'/'.$value->id)}}" method="post" role="form"  style="width: 30; height: 30; display: none;" class="rep-form{{$value->id }}" enctype="multipart/form-data" file="true" >
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <!--  show reply comment -->
            <div  class="rep-form">
               @foreach($rep_comment as $val)
               @if($val->father_id == $value->id)
               <form role="form">
                <div>
                   <img src="{{asset('source/assets/dest/images/default_avatar.png')}}" alt="" width="30" height="30" >
                   <span style="color: blue"><b>{{$val->user->name}}</b>&nbsp;</span>
                   <small> {{$val->created_at}} </small>&nbsp;<br>{{$val->content}}
               </div>
                
           </form>
           @endif 
           @endforeach 
            <div class="form-group">
                <textarea class="form-control" name="content" rows="1" placeholder="Reply Comment here!"></textarea>
            </div>
            <div class="form-group" >
                <div  class="rep_img_fied{{$value->id}}" >
                    <label>Images</label>
                    <button type="button" class="btn btn-default" aria-label="Left Align" >
                    <a href="javascript:void(0)" class="rep-i" data-a={{$value->id }}>Add</a><br>
                    </button>
                    <input type="file" name="repImages[]" />
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Reply</button>
        </form>
 </div>

 @endif
 @endforeach
 <!-- Comments Form -->
 <div>
    <h4>Comment ...<span class="glyphicon glyphicon-pencil"></span></h4>
    <form action="{{ route('post.comment',$trip_id) }}" method="post" role="form"  enctype="multipart/form-data" file="true"  >
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <div class="comment-form">
            <textarea class="form-control" name="content" rows="1" placeholder="Enter Comment here!"></textarea>
        </div>

        <div class="form-group" id="img_fied">
            <label>Images</label>
            <button type="button" class="btn btn-default" aria-label="Left Align" id="addimg">'
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </button>
            <input type="file" name="fImages[]" />
        </div>
        <button type="submit" class="btn btn-primary">Post comment</button>
    </form>
</div> 
<hr>
</div>
</div>
</div>
<!-- Posted Comments -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $(".rep-a").click(function(){
            id=$(this).attr("data-a");
            $(".rep-form"+id).slideToggle();
        });
        $(".rep-i").click(function(){
            id=$(this).attr("data-a");
            console.log(id);
            $(".rep_img_fied"+id).append('<input type="file" name="repImages[]" />');
        });
        $("#addimg").click(function(){
            $("#img_fied").append('<input type="file" name="fImages[]" />');
        })
    });
</script>
@stop