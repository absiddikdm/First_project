<?php

namespace App\Http\Controllers;

use App\Mail\SubscribeMail;
use App\Models\Subscribe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class SubscribeController extends Controller
{
   function subscribe_store(Request $request){
        if($request->email == ''){
            return redirect()->route('index', '#subs')->with('email', 'Enter Your Email');
        }
        else{
              Subscribe::insert([
                'email'=>$request->email,
                'created_at'=>Carbon::now(),
              ]);
              return redirect()->route('index', '#subs')->with('subs', 'Your Successfully Subscribe');
        }
   }
        function subscribe_list(){
            $subscribers = Subscribe::all();
         return view('admin.subscriber.list',[
            'subscribers'=>$subscribers,
         ]);

       }
       function subs_delete($id){
        Subscribe::find($id)->delete();
        return back();
      }


      function send_subscribe_mail($id){
        $subcribe = Subscribe::find($id);
         $subcriber_email = $subcribe->email;

         Mail::to($subcriber_email)->send(new SubscribeMail($subcriber_email));

         return back()->with('send_mail', "Mail Sent Successfully to <b>$subcriber_email</b>");

      }
}
