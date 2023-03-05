<?php

namespace App\Policies;

use App\Models\Hash;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HashPolicy
{
    use HandlesAuthorization;

    public function hashBelongsCurrentUser(User $user, Hash $hash) {
        return $hash->event->user->id === $user->id;
    }
}
