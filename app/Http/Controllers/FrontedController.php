<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\AuthorSocial;
use App\Models\Category;
use App\Models\Post;
use App\Models\Social;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Middleware\ShareErrorsFromSession;
class FrontedController extends Controller
{
    function index(){
        $categories = category::all();
        $slider_post = Post::latest()->take(4)->where('status',1)->get();
        $recent_post = Post::latest()->where('status',1)->paginate(6);
        $tags = Tag::latest()->get();
        $socials = Social::where('status', 1)->get();
      return view('frontend.index', [
        'categories'=> $categories,
        'slider_post'=> $slider_post,
        'recent_post'=> $recent_post,
        'tags'=> $tags,
        'socials'=> $socials,
      ]);
    }
    function author_login(){
        return view('frontend.author_login');
    }
    function author_register(){
        return view('frontend.author_register');
    }

        function blog_details($slug){ 
          $post = Post::where('slug', $slug)->first();
          $post_details = Post::find($post->id);
          $url = url()->current();
          $author_social = AuthorSocial::where('author_id', $post->author_id)->get();
          $shareButtons = \Share::page(
              "$url",
            "$post_details->title",
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram();
          return view('frontend.blog_details',[
            'post_details'=> $post_details,
            'author_social'=> $author_social,
            'shareButtons'=> $shareButtons,
          ]);
        }
      function cetegory_blog($id){  
        $category_info = Category::find($id);
        $category_blogs = Post::where('category_id', $id)->get();
        return view('frontend.category_blog', [
          'category_blogs'=>$category_blogs,
          'category_info'=>$category_info,
        ]);
      }

      function author_blog($id){  
        $author =Author::find($id);
        $socials =AuthorSocial::where('author_id',$id)->get();
        $author_blogs = Post::where('author_id', $id)->get();
        return view('frontend.author_blog', [
          'author_blogs'=>$author_blogs,
          'author'=>$author,
          'socials'=>$socials,
        ]);
      }
      function all_blog(){
        $all_blogs = Post::where('status',1)->paginate(4);
        return view('frontend.all_blog', [
          'all_blogs'=>$all_blogs,
        ]);
      }
      function all_author_list(){
        $authors = Author::where('author',1)->paginate(2);
        return view('frontend.author_list',[
          'authors'=>$authors,
        ]);
      }

      function tag_blog($id){
        $tag_info = Tag::find($id);
        
        return view('frontend.tag_blog',[
            'tag_info'=>$tag_info,
        ]);
      }
}
