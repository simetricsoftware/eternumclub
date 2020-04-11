<?php

namespace App\Traits;

use App\Vote;

/**
 *
 */
trait Voteable
{
    public function saveVote($model, $type) {
        $user = auth()->user();
        $vote = Vote::where('user_id', $user->id)->where('voteable_id', $model->id)->get()->first();
        if (!$vote) {
            $vote = new Vote([
                    'user_id'       => $user->id,
                    'vote_type'     => $type
                ]);
            $vote->voteable()->associate($model)->save();
        } elseif ($vote->vote_type !== $type) {
            $vote->vote_type = $type;
            $vote->save();
        } else {
            $vote->delete();
        }
    }
}
