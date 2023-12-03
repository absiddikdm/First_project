<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuthorRegisterController extends Controller
{
    function author_register_store(Request $request){
        $request->validate([
            'username'=>'required',
            'email'=>'required',
            'password'=>'required',

        ]);

        Author::insert([
           'username'=>$request->username,
           'email'=>$request->email,
           'password'=>bcrypt($request->password),
           'created_at'=>Carbon::now(),
        ]);
        return back()->with('success', 'User Registerd Success ');
    }
}
