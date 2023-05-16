<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\ResponseFormat;
use App\Http\Resources\ResponseFormatter;
use Illuminate\Http\Request;
use App\Models\Product;
use GuzzleHttp\Psr7\Response;

class ProductController extends Controller
{
    public function all(Request $request)
    {
        $id     = $request->input('id');
        $limit  = $request->input('limit', 6);
        $name   = $request->input('name');
        $slug   = $request->input('slug');
        $type   = $request->input('type');
        $price_from   = $request->input('price_from');
        $price_to   = $request->input('price_to');

        //data product hanya memiliki 1 id
        if ($id) {
            $product = Product::with('galleries')->find($id);
            if ($product) {
                return ResponseFormat::success($product, 'Data berhasil diambil!');
                // return new ResponseFormatter(true, 'Data produk berhasil di ambil', $product);
            } else {
                return ResponseFormat::error(null, 'Data gagal di ambil!', 404);
                // return new ResponseFormatter(false, 'Data gagal di ambil', null);
            }
        }

        //data product hanya memiliki 1 slug
        if ($slug) {
            $product = Product::with('galleries')->where('slug', $slug)->first();
            if ($product) {
                return ResponseFormat::success($product, 'Data berhasil diambil!');
                // return new ResponseFormatter(true, 'Data produk berhasil di ambil', $product);
            } else {
                return ResponseFormat::error(null, 'Data gagal di ambil!', 404);
                // return new ResponseFormatter(false, 'Data gagal di ambil', null);
            }
        }


        $product = Product::with('galleries');

        if ($name) {
            $product->where('like', '%' . $name . '%');
        }
        if ($type) {
            $product->where('like', '%' . $type . '%');
        }
        if ($price_from) {
            $product->where('price', '>=', $price_from);
        }
        if ($price_to) {
            $product->where('price', '<=', $price_to);
        }

        return ResponseFormat::success(
            $product->paginate($limit),
            'Data list product..'
        );
    }
}
