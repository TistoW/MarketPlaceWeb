<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BaseController extends Controller {
    use Helper;

    public function upload(Request $request, $path) {
        $fileName = "";
        if ($request->image) {
            $image = $request->image->getClientOriginalName();
            $image = str_replace(' ', '', $image);
            $image = date('Hs') . rand(1, 999) . "_" . $image;
            $fileName = $image;
            $request->image->storeAs('public/' . $path, $image);
            return $this->success($fileName);
        } else {
            return $this->error("Image wajib di kirim");
        }
    }
}
