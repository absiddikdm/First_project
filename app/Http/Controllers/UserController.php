<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
function profile(){
    return view('admin.user.profile');
}
function profile_update(Request $request){
    if($request->photo==''){
      user::find(Auth::id())->update([
       'name'=>$request->name,
      ]);

      return back()->with('success','profile Updated!');
    }
    else{

        if(Auth::user()->photo != null){
           $cuurent = public_path('uploads/users/'.Auth::user()->photo);
           unlink($cuurent);
        }

        $photo = $request->photo;
       $extension = $photo->extension();
       $file_name =Auth::id().'.'.$extension;
       Image::make($photo)->save(public_path('uploads/users/'.$file_name));
       user::find(Auth::id())->update([
        'name'=>$request->name,
        'photo'=> $file_name,
       ]);
       return back()->with('success','profile Updated!');
    }

}
   function user_list(){
    $users = user::all();
    return view('admin.user.user_list', compact('users'));
   }
   function password_update(Request $request){
    $request->validate([
      'current_password'=>'required',
      'password'=>['required','confirmed',Password::min(8)
      ->letters()
      ->mixedCase()
      ->numbers()
      ->symbols()],
      'password_confirmation'=>'required',

    ]);
    if(Hash::check($request->current_password, Auth::user()->password)){
       user::find(Auth::id())->update([
          'password'=>bcrypt($request->password),
       ]);
       return back()->with('pass_update','Password Updated!');
    }
    else{
        return back()->with('wrong','Current Password Does Not Match!');
    }

   }
   function user_delete($id){
    user::find($id)->delete();
    return back()->with('delete', 'User Delete Success');
   }
}

