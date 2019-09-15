<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\NotificationResource;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('JWT');
    }

    public function unRead()
    {
        $currentUser = auth()->user();
        return response([
            'message' => 'OK',
            'data' => [
                'unread' => NotificationResource::collection($currentUser->unreadNotifications),
                'unreadCount' => $currentUser->unreadNotifications->count(),
            ],
        ], Response::HTTP_OK);
    }
    
    public function readIt($id)
    {
        $currentUser = auth()->user();
        $currentUser->unreadNotifications()->where('id', $id)->get()->markAsRead();

        return response([
            'message' => 'OK',
        ], Response::HTTP_ACCEPTED);
    }
}
