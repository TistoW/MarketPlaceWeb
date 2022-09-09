<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller {

    use Helper;

    public function index() {

    }

    public function create() {

    }

    public function store(Request $request): JsonResponse {
        $validasi = Validator::make($request->all(), [
            'tokoId' => 'required',
            'name' => 'required',
            'description' => 'required',
            'wight' => 'required', // gram
            'price' => 'required',
            'stock' => 'required',
        ]);

        if ($validasi->fails()) {
            return $this->error($validasi->errors()->first());
        }

        $toko = Product::create($request->all());
        return $this->success($toko);
        //
    }

    public function show($id) {
        $alamat = Product::where('tokoId', $id)->where('isActive', true)->get();
        return $this->success($alamat);
    }

    public function edit($id) {
        //
    }

    public function update(Request $request, $id) {
        $alamat = Product::where('id', $id)->first();
        if ($alamat) {
            $alamat->update($request->all());
            return $this->success($alamat);
        } else {
            return $this->error("Product tidak ditemukan");
        }
    }

    public function destroy($id) {
        $alamat = Product::where('id', $id)->first();
        if ($alamat) {
            $alamat->update([
                'isActive' => false
            ]);
            return $this->success($alamat, "Product berhasil dihapus");
        } else {
            return $this->error("Product tidak ditemukan");
        }
    }
}
