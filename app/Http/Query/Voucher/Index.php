<?php
namespace App\Http\Query\Voucher;

use App\Post;
use App\Voucher;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Index {
    public function query(Request $request, Post $post): Builder {
        $q_voucher = Voucher::whereHas('tickets', function ($query) use ($post, $request) {
            $query->where('post_id', $post->id);

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
        });

        $status = $request->get('filter')['status'] ?? null;
        if ($status) {
            if ($status === 'pending') {
                $q_voucher->whereDoesntHave('tickets', function ($query) {
                    $query->whereNotNull('sent_at');
                });
            } else if ($status === 'processed') {
                $q_voucher->whereDoesntHave('tickets', function ($query) {
                    $query->whereNull('sent_at');
                });
            }
        }

        return $q_voucher;
    }
}
