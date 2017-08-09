<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trip;
use App\Comment;
use App\Picture;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\UploadedFile;
// class CommentController extends Controller
// {
    //
  // public function post_comment(Request $request, $id){
       // $trip= Trip::find($id);//tìm id của trip hiện đang comment;
//        $comment= new Comment;
//        $comment->user_id=Auth::user()->id; 
//        $comment->trip_id;
//        $comment->picture_id=$request->picture_id; 
//        $comment->content=$request->content;
//         $file = $request->file('images');
//         $filename=Carbon::now()->format('YmdHs').'.jpg';
//         $part='source/assets/dest/images/comments';
//         //url de luu database
//         $img_url=$part.$filename;
//         $file->move($part,$filename);
//        $comment->save(); 
//         return redirect()->route('get.comment');
//   }
//   public function get_comment(){
//     $comment = Comment::all();
//     $rep_comment =Comment::where('father_id','<>',0)->get();
//     return view('comment',['comment'=>$comment],['rep_comment'=>$rep_comment]);
//   }
//    public function get_rep_comment(){
//     $comment = Comment::all();
//     $rep_comment =Comment::where('father_id','<>',0)->get();

//     return view('comment',['comment'=>$comment],['rep_comment'=>$rep_comment]);;
//   } 
//       public function post_rep_comment(Request $request, $id){
//        $father_id= Comment::find($id);//tìm id của comment_father;
//        $rep_comment= new Comment;
//        $rep_comment->father_id=$id;
//        $rep_comment->user_id= Auth::user()->id; 
//        $rep_comment->trip_id= 1;
//        $rep_comment->picture_id=$request->picture_id; 
//        $rep_comment->content=$request->content;
//        $rep_comment->save(); 

//         return redirect()->route('get.comment');
//   }

// }



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
  public function get_comment(Request $request, $trip_id){
    $comment = Comment::where('trip_id',$trip_id)->get();
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

