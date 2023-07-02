<?php
namespace App\Http\Query\BankAccount;

use App\Post;
use Illuminate\Database\Eloquent\Builder;

class Index {
    public function query(Post $post): Builder {
        return $post->bankAccounts()->getQuery();
    }
}
