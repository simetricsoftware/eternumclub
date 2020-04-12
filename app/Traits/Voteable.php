<?php

namespace App\Traits;

use App\Vote;

/**
 *
 */
trait Voteable
{
    public function saveVote($model, $type) {
        $user = auth()->user('api');
        $vote = $model->votes()->where('user_id', $user->id)->get()->first();
        if (!isset($vote)) {
            $vote = new Vote([
                    'user_id'       => $user->id,
                    'vote_type'     => $type
                ]);
            $vote->voteable()->associate($model);
            $vote->save();
        } elseif ($vote->vote_type !== $type) {
            $vote->vote_type = $type;
            $vote->save();
        } else {
            $vote->delete();
        }
    }

    public function scopeVotesCount($query) {
        return $query->withCount([
            'votes', 'votes as likes' => function($vote) {
                $vote->where('vote_type','like');
            },
            'votes', 'votes as dislikes' => function($vote) {
                $vote->where('vote_type','dislike');
            }
        ]);
    }

    public function scopeVotesUser($query, $user) {
        if ($user) {
            return $query->with([
                'votes' => function($vote) use ($user){
                    $vote->where('user_id', $user->id);
                }
            ]);
        }
    }
}
