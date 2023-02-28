<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'start_date', 'end_date', 'description',
    ];

    public function hashes() {
        return $this->hasMany(Hash::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function scopeForUser(Builder $builder, User|int $user_id) {
        if ($user_id instanceof User) {
            $user_id = $user_id->id;
        }
        return $builder->whereHas('user', fn($q_user) => $q_user->where('id', $user_id));
    }

    public function scopeForCurrentUser(Builder $builder) {
        $current_user = Auth::user();

        return $builder->forUser($current_user);
    }
}
