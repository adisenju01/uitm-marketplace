<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\PaypalSetting;
use App\Models\StripeSetting;
use App\Http\Controllers\Controller;

class PaymentSettingController extends Controller
{
    public function index()
    {
        $paypalSetting = PaypalSetting::first();
         $stripeSetting = StripeSetting::first();
        return view('admin.payment-settings.index', compact('paypalSetting', 'stripeSetting'));
    }
}
