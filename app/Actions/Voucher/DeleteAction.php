<?php
namespace App\Actions\Voucher;

use App\Post;
use App\Voucher;
use Illuminate\Support\Facades\Storage;

class DeleteAction {
    public function execute(Voucher $voucher, Post $post) {
        Storage::delete($voucher->file);

        $voucher->tickets()->delete();

        $voucher->answers()->delete();

        $voucher->delete();
    }
}
