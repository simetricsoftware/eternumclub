<?php
namespace App\Actions\BankAccount;

use App\Http\Requests\BankAccount\StoreRequest;
use App\Post;

class StoreAction {
    public function execute(StoreRequest $request, Post $post) {
        $post->bankAccounts()->delete();

        if ($request->bankAccounts) {
            $post->bankAccounts()->createMany($request->bankAccounts);
        }
    }
}
