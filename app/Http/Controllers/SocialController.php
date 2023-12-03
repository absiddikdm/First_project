<?php

namespace App\Http\Controllers;

use App\Models\Social;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SocialController extends Controller
{
   function social(){
    $socials = Social::all();
    return view('admin.social.social',[
        'socials'=> $socials,
    ]);
   }

   function social_store(Request $request){
        Social::insert([
           'icon_class'=>$request->icon_class,
           'social_name'=>$request->social_name,
           'social_link'=>$request->social_link,
          'created_at'=>Carbon::now(),
        ]);
        return back();
   }

   function social_status_change($id){
      $social = social::find($id);
      if($social->status == 1){
         Social::find($id)->update([
            'status'=>0,
         ]);
         return back();
      }
      else{
         Social::find($id)->update([
            'status'=> 1,
         ]);
         return back();
      }
   }

   function social_delete($id){
      Social::find($id)->delete();
      return back();
   }

   

}
