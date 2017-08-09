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
                 <img src="source/assets/dest/images/default_avatar.png" alt="" width="40" height="40" >
                 <span style="color: blue"><b>{{$value->user->name}}</b>&nbsp;</span>
                 <small> {{$value->created_at}} </small>&nbsp; <a href="javascript:void(0)" class="rep-a" data-a={{$value->id }}>Reply</a><br>
                 {{$value->content}} 
                 <img src="$part/$filename">
             </div>    
         </form>
        
      <!--   Reply comment Form -->
         <form action="{{route('post.rep.comment',$value->id)}}" method="POST" role="form"  style="width: 30; height: 30; display: none;" class="rep-form{{$value->id }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <!--  show reply comment -->
            <div  class="rep-form">
               @foreach($rep_comment as $val)
               @if($val->father_id == $value->id)
               <form role="form">
                <div>
                   <img src="source/assets/dest/images/default_avatar.png" alt="" width="30" height="30" >
                   <span style="color: blue"><b>{{$val->user->name}}</b>&nbsp;</span>
                   <small> {{$val->created_at}} </small>&nbsp;<br>{{$val->content}}
                   @if($val->picture_id <> NULL)
                   {{$val->pictures->url}}
                   @endif
               </div>
                
           </form>
           @endif
           @endforeach 
            <div class="form-group">
                <textarea class="form-control" name="content" rows="1" placeholder="Reply Comment here!"></textarea>
            </div>
            <div class="form-group">
                <label>Images</label>
                <input type="file" name="fImages">
            </div>
            <button type="submit" class="btn btn-primary">Reply</button>
        </form>
 </div>
 @endif
 @endforeach
 <!-- Comments Form -->
 <div>
    <h4>Comment ...<span class="glyphicon glyphicon-pencil"></span></h4>
    <form action="{{ route('post.comment', 1) }}" method="POST" role="form"  enctype="multipart/form-data" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <div class="comment-form">
            <textarea class="form-control" name="content" rows="1" placeholder="Enter Comment here!"></textarea>
        </div>

        <div class="form-group">
            <label>Images</label>
            <input type="file" name="images">
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
    });
</script>
@stop





class CommentController extends Controller
{
    //
  public function post_comment(Request $request, $id){
       // $trip= Trip::find($id);//tìm id của trip hiện đang comment;
    $image = Input::file('fImages');
    $file_name = $image[0]->getClientOriginalName();
    $comment= new Comment;
    $comment->user_id=Auth::user()->id; 
    $comment->trip_id;
    $comment->content=$request->content;
    $comment->save();
       if(Input::hasFile('fImages')){
         foreach (Input::file('fImages') as $file) {
        $image = new Picture();
        if(isset($file)){
        $image->url='source/assets/dest/images/comments/'.$file_name;
        $image->user_id=Auth::user()->id; 
        $image->trip_id;
        $image->comment_id = $comment->id;
        $file->move('source/assets/dest/images/comments/',$file);
        $image->save();    
       }
      }
    }
    $url='source/assets/dest/images/comments/'.$file_name;
    
   
    dd($url);
    
    $url = Picture::where('id',$picture_id)->pluck('status')->last();


    return redirect()->route('get.comment');
  }
  public function get_comment(){
    $comment = Comment::all();
    $rep_comment =Comment::where('father_id','<>',0)->get();
    return view('comment',['comment'=>$comment],['rep_comment'=>$rep_comment]);
  }
   public function get_rep_comment(){
    $comment = Comment::all();
    $rep_comment =Comment::where('father_id','<>',0)->get();

    return view('comment',['comment'=>$comment],['rep_comment'=>$rep_comment]);;
  } 
      public function post_rep_comment(Request $request, $id){
       $father_id= Comment::find($id);//tìm id của comment_father;
       $rep_comment= new Comment;
       $rep_comment->father_id=$id;
       $rep_comment->user_id= Auth::user()->id; 
       $rep_comment->trip_id= 1;
       $rep_comment->content=$request->content;
       $rep_comment->save(); 
      
        return redirect()->route('get.comment');
  }

}




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
                 <img src="source/assets/dest/images/default_avatar.png" alt="" width="40" height="40" >
                 <span style="color: blue"><b>{{$value->user->name}}</b>&nbsp;</span>
                 <small> {{$value->created_at}} </small>&nbsp; <a href="javascript:void(0)" class="rep-a" data-a={{$value->id }}>Reply</a><br>
                 {{$value->content}} 
                 <img src="$part/$filename">
             </div>    
         </form>
        
      <!--   Reply comment Form -->
         <form action="{{route('post.rep.comment',$value->id)}}" method="POST" role="form"  style="width: 30; height: 30; display: none;" class="rep-form{{$value->id }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <!--  show reply comment -->
            <div  class="rep-form">
               @foreach($rep_comment as $val)
               @if($val->father_id == $value->id)
               <form role="form">
                <div>
                   <img src="source/assets/dest/images/default_avatar.png" alt="" width="30" height="30" >
                   <span style="color: blue"><b>{{$val->user->name}}</b>&nbsp;</span>
                   <small> {{$val->created_at}} </small>&nbsp;<br>{{$val->content}}
               </div>
                
           </form>
           @endif 
           @endforeach 
            <div class="form-group">
                <textarea class="form-control" name="content" rows="1" placeholder="Reply Comment here!"></textarea>
            </div>
            <div class="form-group">
                <label>Images</label>
                <input type="file" name="fImages">
            </div>
            <button type="submit" class="btn btn-primary">Reply</button>
        </form>
 </div>

 @endif
 @endforeach
 <!-- Comments Form -->
 <div>
    <h4>Comment ...<span class="glyphicon glyphicon-pencil"></span></h4>
    <form action="{{ route('post.comment', 1) }}" method="POST" role="form"  enctype="multipart/form-data" file="true"  >
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <div class="comment-form">
            <textarea class="form-control" name="content" rows="1" placeholder="Enter Comment here!"></textarea>
        </div>
        @for($i=1;$i<=2;$i++)
        <div class="form-group">
            <label>Images</label>
            <input type="file" name="fImages[]" value="{!! old('fImages') !!}" />
        </div>
        @endfor
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
    });
</script>
@stop
