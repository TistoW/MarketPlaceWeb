<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller {

    use Helper;

    public function index() {
        $alamat = Category::where('isActive', true)->get();
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

        $toko = Category::create($request->all());
        return $this->success($toko);
        //
    }

    public function show($id) {
        $alamat = Category::where('tokoId', $id)->where('isActive', true)->get();
        return $this->success($alamat);
    }

    public function edit($id) {
        //
    }

    public function update(Request $request, $id) {
        $alamat = Category::where('id', $id)->first();
        if ($alamat) {
            $alamat->update($request->all());
            return $this->success($alamat);
        } else {
            return $this->error("Category tidak ditemukan");
        }
    }

    public function destroy($id) {
        $alamat = Category::where('id', $id)->first();
        if ($alamat) {
            $alamat->update([
                'isActive' => false
            ]);
            return $this->success($alamat, "Category berhasil dihapus");
        } else {
            return $this->error("Category tidak ditemukan");
        }
    }
}
