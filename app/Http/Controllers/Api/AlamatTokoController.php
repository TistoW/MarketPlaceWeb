<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AlamatToko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlamatTokoController extends Controller {
    public function index() {

    }

    public function create() {

    }

    public function store(Request $request) {
        $validasi = Validator::make($request->all(), [
            'alamat' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kodepost' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        if ($validasi->fails()) {
            return $this->error($validasi->errors()->first());
        }

        $toko = AlamatToko::create($request->all());
        return $this->success($toko);
        //
    }

    public function show($id) {
        $alamat = AlamatToko::where('tokoId', $id)->where('isActive', true)->get();
        return $this->success($alamat);
    }

    public function edit($id) {
        //
    }

    public function update(Request $request, $id) {
        $alamat = AlamatToko::where('id', $id)->first();
        if ($alamat) {
            $alamat->update($request->all());
            return $this->success($alamat);
        } else {
            return $this->error("Alamat tidak ditemukan");
        }
    }

    public function destroy($id) {
        $alamat = AlamatToko::where('id', $id)->first();
        if ($alamat) {
            $alamat->update([
                'isActive' => false
            ]);
            return $this->success($alamat, "Alamat berhasil dihapus");
        } else {
            return $this->error("Alamat tidak ditemukan");
        }
    }

    public function success($data, $message = "success") {
        return response()->json([
            'code' => 200,
            'message' => $message,
            'data' => $data
        ]);
    }

    public function error($message) {
        return response()->json([
            'code' => 400,
            'message' => $message
        ], 400);
    }
}
