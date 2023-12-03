<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
  function add_post(){
    $categories = Category::all();
    $tags = Tag::all();
    return view('admin.author.post.add_post', [
        'categories'=> $categories,
        'tags'=> $tags,
    ]);
  }
  function post_store(PostRequest $request){
  $slug =  str_replace(' ', '_',Str::lower($request->title)). '_'.random_int(1000000,9999900).uniqid();
  $after_implode_tag = implode(',', $request->tags);

     //thumbnail
     $thumbnail = $request->thumbnail;
    $extension = $thumbnail->extension();
   $thum_name = str_replace(' ', '_',Str::lower(substr($request->title, 0, 500))). '_'.random_int(10000,99999).'.'.$extension;
     Image::make($thumbnail)->save(public_path('uploads/post/thumb/'. $thum_name));

        //cover
     $cover_image = $request->cover_image;
     $extension2 = $thumbnail->extension();
     $cover_name = str_replace(' ', '_',Str::lower(substr($request->title, 0, 500))). '_'.random_int(10000,99999).'.'.$extension2;
     Image::make($cover_image)->save(public_path('uploads/post/cover/'. $cover_name));

        Post::insert([
            'author_id'=>Auth::guard('author')->id(),
           'category_id'=>$request->category_id,
            'title'=>$request->title,
            'desp'=>$request->desp,
            'thumbnail'=>$thum_name,
            'cover_image'=>$cover_name,
            'tags'=>$after_implode_tag,
             'slug'=> $slug,
            'created_at'=> Carbon::now(),
         ]);
         return back()->with('success', 'Post Added Successfully');
   }

   function post_list(){
    $posts = post::where('author_id', Auth::guard('author')->id())->get();
    return view('admin.author.post_list',[
        'posts'=> $posts,
    ]);

   }

   function status_change($id){
    $post = post::find($id);
    if($post->status == 1){
         post::find($id)->update([
            'status'=>0,
         ]);
    }
    else{
        post::find($id)->update([
            'status'=>1,
         ]);
    }
    return back();
   }
}
