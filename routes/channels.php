<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('notifications', function($user) {
    return $user != null;
});

Broadcast::channel('chat', function($user) {
    if($user) {
        return [
            'id' => $user->id,
            'name' => $user->name
        ];
    }
    return false;
});