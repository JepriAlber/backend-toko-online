<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $income = Transaction::where('transaction_status', 'SUCCESS')->sum('transaction_total');
        $sales  = Transaction::count();
        $orders  = Transaction::orderBy('id', 'DESC')->take(5)->get();
        $pie    = [
            'pending' => Transaction::where('transaction_status', 'PENDING')->count(),
            'success' => Transaction::where('transaction_status', 'SUCCESS')->count(),
            'failed'  => Transaction::where('transaction_status', 'FAILED')->count()
        ];

        return view('pages.dashboard')->with([
            'income' => $income,
            'sales' => $sales,
            'orders' => $orders,
            'pie'   => $pie
        ]);
    }
}
