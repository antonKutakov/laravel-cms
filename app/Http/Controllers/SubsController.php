<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription;
use App\Mail\SubscribeEmail;
use Illuminate\Support\Facades\Mail;

class SubsController extends Controller
{
    public function subscribe(Request $request){
        $this->validate($request, [
            'email' => 'required|email|unique:subscriptions'
        ]);
        $subs = Subscription::add($request->get('email'));

        Mail::to($subs)->send(new SubscribeEmail($subs));

        return redirect()->back()->with('status', 'Проверьте вашу почту!');
    }
}
