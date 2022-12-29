<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper;
use App\Models\Product;
use App\Models\User;
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

    public function show($id): JsonResponse {
        $alamat = Product::where('tokoId', $id)
            ->with(['category:id,name'])
            ->where('isActive', true)
            ->get();
        return $this->success($alamat);
    }

    public function detailProduct($id): JsonResponse {
        $product = Product::where('id', $id)
            ->with([
                'category:id,name',
                'store:id,name',
                'store.address:id,tokoId,kota',
            ])
            ->where('isActive', true)
            ->first();
        if ($product) {
            return $this->success($product);
        }

        return $this->error("Product not found");

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

    public function upload(Request $request) {
        $fileName = "";
        if ($request->image) {
            $image = $request->image->getClientOriginalName();
            $image = str_replace(' ', '', $image);
            $image = date('Hs') . rand(1, 999) . "_" . $image;
            $fileName = $image;
            $request->image->storeAs('public/product', $image);

            return $this->success($fileName);
        } else {
            return $this->error("Image wajib di kirim");
        }
    }
}
