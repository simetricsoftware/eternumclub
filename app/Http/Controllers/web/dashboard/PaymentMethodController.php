<?php

namespace App\Http\Controllers\web\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class PaymentMethodController extends Controller
{
    public function createSubscription() {
        $user = auth()->user('api');
        return view('customers.paymentmethods.subscriptions', ['intent' => $user->createSetupIntent(), 'pk' => config('app.stripe_pk')]);
    }

    public function storeSubscription(Request $request) {
        $user = auth()->user('api');
        $user->addPaymentMethod($request->payment_method);
    }

    public function showSubscriptions() {
        $user = auth()->user('api');
        dd($user->paymentMethods());
    }

    public function createSingleCharge() {
        $user = auth()->user('api');
        return view('customers.paymentmethods.singlecharges', ['pk' => config('app.stripe_pk')]);
    }

    public function storeSingleCharge(Request $request) {
        $user = auth()->user('api');
        $user->charge(5040, $request->id);
    }

    public function showSingleCharges() {
        return view('customers.paymentmethods.subscriptions');
    }
}
