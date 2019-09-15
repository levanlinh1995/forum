<?php

namespace App\Http\Controllers;

use App\Model\Reply;
use App\Model\Question;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\ReplyResource;
use App\Notifications\ReplyNotification;
use App\Events\ReplyAddedEvent;
use App\Events\ReplyDeletedEvent;



class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question)
    {
        return ReplyResource::collection($question->replies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
        $reply = $question->replies()->create(array_merge($request->all(), [
            'user_id' => auth()->user()->id,
        ])); 

        $questionAuth = $question->user;
        $currentUser = auth()->user();
        if ($questionAuth->id !== $currentUser) {
            $questionAuth->notify(new ReplyNotification($reply));
        }

        event(new ReplyAddedEvent($reply));

        return response([
            'reply' => new ReplyResource($reply)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question, Reply $reply)
    {
         return new ReplyResource($reply);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Question $question, Reply $reply)
    {

        $reply->body = $request->body;
        $reply->user_id = auth()->user()->id;
        $reply->save();

        return response([
            'reply' => new ReplyResource($reply)
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Reply $reply)
    {
        $reply->delete();
        event(new ReplyDeletedEvent($reply->id));

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
