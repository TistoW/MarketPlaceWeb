<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller {

    use Helper;

    public function index() {
        $alamat = Slider::where('isActive', true)->get();
        return $this->success($alamat);
    }

    public function create() {

    }

    public function store(Request $request) {
        $validasi = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required',
        ]);

        if ($validasi->fails()) {
            return $this->error($validasi->errors()->first());
        }

        $toko = Slider::create($request->all());
        return $this->success($toko);
        //
    }

    public function show($id): JsonResponse {
        $alamat = Slider::where('tokoId', $id)->where('isActive', true)->get();
        return $this->success($alamat);
    }

    public function edit($id) {
        //
    }

    public function update(Request $request, $id): JsonResponse {
        $alamat = Slider::where('id', $id)->first();
        if ($alamat) {
            $alamat->update($request->all());
            return $this->success($alamat);
        } else {
            return $this->error("Slider tidak ditemukan");
        }
    }

    public function destroy($id): JsonResponse {
        $alamat = Slider::where('id', $id)->first();
        if ($alamat) {
            $alamat->delete();
            return $this->success($alamat, "Slider berhasil dihapus");
        } else {
            return $this->error("Slider tidak ditemukan");
        }
    }
}
