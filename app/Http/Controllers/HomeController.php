<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\AuthoRequest;
use App\Models\AuthorSocial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    function author_req_list(){
        $lists = AuthoRequest::where('status', '!=',1)->get();
        return view('admin.author.author_req',[
            'lists'=> $lists,
        ]);
     }
     function author_list(){
        $lists = AuthoRequest::where('status', 1)->get();
        return view('admin.author.author_list',[
            'lists'=> $lists,
        ]);
     }
     function req_accept($id){
        $author = AuthoRequest::find($id);
        AuthoRequest::find($id)->update([
            'status'=>1,
        ]);

        Author::find($author->author_id)->update([
            'author'=>1,
        ]);
        return back()->with('success', 'Request Accepted');
     }
         function author_deactive($id){
        $author = AuthoRequest::find($id);
        AuthoRequest::find($id)->update([
            'status'=>0,
        ]);

        Author::find($author->author_id)->update([
            'author'=>0,
        ]);
        return back()->with('success', 'Author Deactivated');
     }

     function req_delete($id){
        AuthoRequest::find($id)->delete();
        return back();
     }

     function author_del($id){
        $author = AuthoRequest::find($id);
        AuthoRequest::find($id)->delete();
        Author::find($author->author_id)->update([
            'author'=>0,
        ]);
        return back();
     }
   function author_social_store(Request $request){
    AuthorSocial::insert([
        'author_id'=>Auth::guard('author')->id(),
        'icon_class'=>$request->icon_class,
        'social_link'=>$request->social_link,
        'created_at'=>Carbon::now(),
    ]);
    return back();
   }


}
