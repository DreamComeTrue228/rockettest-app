<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Jobs\PaymentHistoryJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;

class PaymentController extends Controller
{
    public function saveOnHistory(Request $request)
    {
        $paymentResult = $request->get("pay");
        $paymentResult["time"] = now();
        Queue::pushOn("payments", new PaymentHistoryJob($paymentResult));
    }
}
