<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

// $user - current user, $id - user is connecting to 
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// $user is current user
Broadcast::channel('notifications', function($user) {
    return $user != null;
});

// $user is current user
Broadcast::channel('chat', function($user) {
    if($user) {
        return [
            'id' => $user->id,
            'name' => $user->name
        ];
    }
    return false;
});

// This is define conditionally for the channel 'chat.greet.{receive_id}'
Broadcast::channel('chat.greet.{receive_id}', function($user, $receive_id) {
    return (int) $user->id === (int) $receive_id;
});