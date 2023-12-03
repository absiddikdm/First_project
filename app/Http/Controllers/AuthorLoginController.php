<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Print_;


class AuthorLoginController extends Controller
{
    function author_login_confirm(Request $request){
       $request->validate([
        'email'=>'required',
        'password'=>'required',
       ]);

       if(Author::where('email', $request->email)->exists()){
          if(Auth::guard('author')->attempt(['email'=>$request->email, 'password'=>$request->password])){
              return redirect()->route('index');
          }
          else{
             return back()->with('passerror', 'Wrong Password!');
          }
       }
       else{
        return back()->with('notexist', 'Email Dose Not Exists');
       }

    }
}
