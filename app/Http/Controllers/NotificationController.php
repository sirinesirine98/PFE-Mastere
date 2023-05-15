<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\OffersNotification;
use Notification;

class NotificationController extends Controller
{
    public function sendNotification()
    {
        $user = User::first();
        $offerData = [
            'name' => "Compixia", 
            'body' => "Vous êtes inviter a rejoindre une téléconsultation", 
            'thanks' => "Merci de joindre la réunion !", 
            'offerText' => "test !!", 
            'offerUrl' => url('/'), 
            'offer_id' => rand(1111,9999), 

        ];

    Notification::send($user, new OffersNotification($offerData));
    dd('Task is completed !');

    }
}
