<?php
namespace App\Actions\Question;

use App\Http\Requests\Question\StoreRequest;
use App\Post;

class StoreAction {
    public function execute(StoreRequest $request, Post $post) {
        $post->questions()->delete();

        if ($request->questions) {
            $post->questions()->createMany($request->questions);
        }
    }
}
