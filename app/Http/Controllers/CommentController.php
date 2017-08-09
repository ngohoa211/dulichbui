<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trip;
use App\Comment;
use App\Picture;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\UploadedFile;
use View;

class CommentController extends Controller
{
    //
  public function post_comment(Request $request,$trip_id){
       // $trip= Trip::find($id);//tìm id của trip hiện đang commen
    $comment= new Comment;
    $comment->user_id=Auth::user()->id; 
    $comment->trip_id=$trip_id;
    $comment->content=$request->content;
    $comment->save();
       if(Input::hasFile('fImages')){
        foreach (Input::file('fImages') as $file) {
        $image = new Picture();
        if(isset($file)){
        $image_name=Carbon::now()->format('YmdHs').$file->getClientOriginalName();
        $image->url='source/assets/dest/images/comments/'.$image_name;
        $image->user_id=Auth::user()->id; 
        $image->trip_id=$trip_id;
        $image->comment_id = $comment->id;
        $file->move('source/assets/dest/images/comments/',$image_name);
        $image->save();    
       }
      }
    }

    return redirect()->route('get.comment',$trip_id);
  }
  public function get_comment(Request $request, $trip_id){
    $comment = Comment::where('trip_id',$trip_id)->get();
    
    $rep_comment =Comment::where('father_id','<>',0)->get();
    //them url anh vao cac value trong comment
    foreach ($comment as  $value) {
      # code...
       $value->imgs=Comment::find($value->id)->pictures;
    }

    return View::make('comment')
    ->with('comment',$comment)
    ->with('rep_comment',$rep_comment)
    ->with('trip_id',$trip_id)
    ;
  }
   public function get_rep_comment(){
    $comment = Comment::all();
    $rep_comment =Comment::where('father_id','<>',0)->get();
    foreach ($rep_comment as  $rep_value) {
      # code...
       $rep_value->imgs=Comment::find($rep_value->id)->pictures;
    }
    return View::make('comment')
    ->with('comment',$comment)
    ->with('rep_comment',$rep_comment)
    ;
  } 
      public function post_rep_comment(Request $request,$trip_id,$father_id){
       $rep_comment= new Comment;
       $rep_comment->father_id=$father_id;
       $rep_comment->user_id= Auth::user()->id; 
       $rep_comment->trip_id= $trip_id;
       $rep_comment->content=$request->content;
       $rep_comment->save(); 
       if(Input::hasFile('repImages')){
        foreach (Input::file('repImages') as $rep_file) {
          $img = new Picture();
          if(isset($rep_file)){
            $rep_img_name=Carbon::now()->format('YmdHs').$rep_file->getClientOriginalName();
            $img->url='source/assets/dest/images/comments/'.$rep_img_name;
            $img->user_id=Auth::user()->id; 
            $img->trip_id=$trip_id;
            $img->comment_id = $rep_comment->id;
            $rep_file->move('source/assets/dest/images/comments/',$rep_img_name);
            $img->save();    
          }
        }
      }
      
        return redirect()->route('get.comment',$trip_id);
  }

}

