<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('like-reply.{replyId}', function ($user, $replyId) {
    return auth()->check();
});

Broadcast::channel('reply-added', function($user) {
    return auth()->check();
});

Broadcast::channel('reply-deleted', function($user) {
    return auth()->check();
});
