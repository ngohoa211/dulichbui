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

    // $array_father_and_rep = array();
    // foreach ($comment_fathers_ids as $comment_father_ids) {
    //     #liet ke comment rep cua moi coment father
    //     $array_rep = new array();
    //     $childs = Comment::findChild($comment_fathers_ids);
    //     foreach($childs as $child){
    //         $array_rep.push($child);
    //     }
    //     $array_father_and_rep.push('$father_id','$array_rep');


    // }
    
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
       $rep_comment->picture_id=$request->picture_id; 
       $rep_comment->content=$request->content;
       $rep_comment->save(); 
        return redirect()->route('get.comment');
  }
 
    
}
