<?php

namespace App\Http\Controllers\web\dashboard;

use App\Actions\Voucher\SendMailAction;
use App\Http\Controllers\Controller;
use App\Http\Query\Voucher\Index;
use App\Post;
use App\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoucherController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Post $post, Index $index, Request $request)
    {
        $vouchers = $index->query($request, $post)->with('assistant', 'tickets.ticketType')->paginate(12);

        return view('dashboard.voucher.index', compact('vouchers', 'post'));
    }

    public function sendMail(Post $post, Voucher $voucher, SendMailAction $sendMailAction)
    {
        try {
            DB::beginTransaction();
            $sendMailAction->execute($voucher, $post);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return back()->withErrors('status', 'No se pudo enviar el correo');
        }

        return back()->with('status', 'Correo enviado');
    }
}
