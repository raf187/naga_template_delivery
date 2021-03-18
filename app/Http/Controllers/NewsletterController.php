<?php

namespace App\Http\Controllers;

use App\Mail\Newsletter;
use App\Models\OldCustomers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function sendNews(){
        $mails = User::where('newsletter', 1)->pluck('email');
        $oldUsers = OldCustomers::all()->pluck('email');

        $content = [
            "restName"=>"Nâga Sophia",
            "hello"=>"Bonjour!",
            "body1"=>\request("message"),
            "body2"=>"",
            "body3"=>"",
            "thanks"=>"À trés bientôt l'equipe Nâga"
        ];

        foreach ($mails as $mail){
            Mail::to($mail)->send(new Newsletter($content));
        }

        foreach ($oldUsers as $user){
            Mail::to($user)->send(new Newsletter($content));
        }


        \session()->flash('notifSuccess', [
            "type" => "success",
            "notif" => "Votre message a bien etait envoyée"
        ]);

        return redirect()->back();
    }
}
