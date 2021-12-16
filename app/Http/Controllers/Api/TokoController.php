<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TokoController extends Controller {

    public function index() {
        //
    }

    public function create() {

    }

    public function store(Request $request) {
        $validasi = Validator::make($request->all(), [
            'userId' => 'required',
            'name' => 'required',
            'kota' => 'required',
        ]);

        if ($validasi->fails()) {
            return $this->error($validasi->errors()->first());
        }

        $toko = Toko::create($request->all());
        return $this->success($toko);
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        //
    }

    public function update(Request $request, $id) {
        //
    }

    public function destroy($id) {
        //
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
//        return response()->json([
//            'ok' => false,
//            'error_code' => 400,
//            'description' => $message
//        ], 400);
    }
}
