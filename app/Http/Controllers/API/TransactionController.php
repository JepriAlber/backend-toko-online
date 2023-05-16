<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function getTransaction(Request $request, $id)
    {
        $product = Transaction::with(['details.product'])->find($id);

        if ($product) {
            return ResponseFormat::success($product, 'Data transaksi berhasil di ambil');
        } else {
            return ResponseFormat::error(null, 'Data transaksi gagal di ambil', 404);
        }
    }
}
