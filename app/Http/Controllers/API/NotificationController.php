<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
     public function index()
    {
        $notifications = Notification::all();

        return response()->json($notifications);
    }
}
