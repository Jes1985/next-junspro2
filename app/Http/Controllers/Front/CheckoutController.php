<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    public function offlineSuccess()
    {
        return view('seller.offline-success');
    }

    public function trialSuccess()
    {
        return view('seller.success');
    }
}
