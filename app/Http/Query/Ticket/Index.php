<?php
namespace App\Http\Query\Ticket;

use App\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Index {
    public function query(Request $request, Post $post): Builder {
        $query = $post->tickets()->getQuery();

        if ($request->has('search')) {
            $query->where(function($query) use ($request) {
                $query->whereHas('assistant', function ($query) use ($request) {
                    $query->where('identification_number', 'like', "%{$request->search}%")
                    ->orWhere('name', 'like', "%{$request->search}%")
                    ->orWhere('email', 'like', "%{$request->search}%");
                })
                ->orWhere('hash', 'like', "%{$request->search}%");
            });
        }

        return $query;
    }
}
