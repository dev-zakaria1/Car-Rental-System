<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = payment::paginate(10);
        return view('dashboard.payment.index', compact('payments'));
    }
}
