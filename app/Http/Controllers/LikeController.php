<?php

namespace App\Http\Controllers;

use App\Model\Like;
use App\Model\Reply;
use Illuminate\Http\Request;
use App\Events\LikeReplyEvent;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('JWT');
    }

    public function likeIt(Reply $reply)
    {
        $reply->likes()->create([
            'user_id' => auth()->id(),
        ]);
        event(new LikeReplyEvent($reply));
    }

    public function unlikeIt(Reply $reply)
    {
        $reply->likes()->where([
            'user_id' => auth()->id(),
        ])->delete();
        event(new LikeReplyEvent($reply));
    }
}
