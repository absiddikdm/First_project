<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\AuthoRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class AuthorController extends Controller
{
    function my_profile(){
        return view('admin.author.profile');
    }
    function author_profile_edit(){
        return view('admin.author.edit');
    }
    function author_profile_update(Request $request){
        if($request->password == ''){
          if($request->photo == ''){
             Author::find(Auth::guard('author')->id())->update([
                'username'=>$request->username,
             ]);
             return back();
          }
          else{
               if(Auth::guard('author')->user()->photo != null){
                $current = public_path('uploads/author/'. Auth::guard('author')->user()->photo);
                unlink($current);
               }
               $photo = $request->photo;
               $extension = $photo->extension();
               $file_name = Auth::guard('author')->id(). '.'.$extension;
               Image::make($photo)->save(public_path('uploads/author/'.$file_name));

               Author::find(Auth::guard('author')->id())->update([
                'username'=>$request->username,
                'photo'=>$file_name,
             ]);
             return back();
          }
        }
        else{
            if($request->photo == ''){
                Author::find(Auth::guard('author')->id())->update([
                    'username'=>$request->username,
                    'password'=>bcrypt($request->password),
                 ]);
                 return back();
            }
            else{
                if(Auth::guard('author')->user()->photo != null){
                    $current = public_path('uploads/author/'. Auth::guard('author')->user()->photo);
                    unlink($current);
                   }
                   $photo = $request->photo;
                   $extension = $photo->extension();
                   $file_name = Auth::guard('author')->id(). '.'.$extension;
                   Image::make($photo)->save(public_path('uploads/author/'.$file_name));

                   Author::find(Auth::guard('author')->id())->update([
                    'username'=>$request->username,
                    'photo'=>$file_name,
                    'password'=>bcrypt($request->password),
                 ]);
                 return back();
        }
    }
}

       function become_author(){
        return view('admin.author.become_author');
     }
        function author_request_store(Request $request){
         AuthoRequest::insert([
           'author_id'=>Auth::guard('author')->id(),
            'email'=>$request->email,
            'created_at'=>Carbon::now(),
         ]);
        return back()->with('sent', 'Your Author Requset Has been sent!');
     }
     function author_logout(){
        Auth::guard('author')->logout();
        return redirect('/');
     }
}
