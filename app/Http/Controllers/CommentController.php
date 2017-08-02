<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trip;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
  public function post_comment(Request $request, $id){
       // $trip= Trip::find($id);//tìm id của trip hiện đang comment;
       $comment= new Comment;
       $comment->user_id=Auth::user()->id; 
       $comment->trip_id;
       $comment->picture_id=$request->picture_id; 
       $comment->content=$request->content;
       $comment->save(); 
        return redirect()->route('get.comment');
  }
  public function get_comment(){
    $comment = Comment::all();
    return view('comment',['comment'=>$comment]);
  }
}
