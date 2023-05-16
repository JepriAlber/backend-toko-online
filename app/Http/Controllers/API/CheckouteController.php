<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\CheckoutRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class CheckouteController extends Controller
{
    public function checkout(CheckoutRequest $request)
    {
        $data = $request->except('transaction_detail'); //ambil data kecuali transaksi detail
        $data['uuid'] = 'TRX' . mt_rand(10000, 99999) . mt_rand(100, 999);

        $transaction = Transaction::create($data);

        //transaction_details berisi [1,2,3..]
        foreach ($request->transaction_details as $product) {
            $details[] = new TransactionDetail([
                'transactions_id' => $transaction, //data ini dapat ketika berhasil melakukan transaksi
                'products_id' => $product
            ]);

            //product hanya bisa beli satu maka kurangi stoknya
            Product::find($product)->decrement('quantity');
        }

        //lalu simpan data transaksi detail
        $transaction->details()->saveMany($details);

        return ResponseFormat::success($transaction);
    }
}
