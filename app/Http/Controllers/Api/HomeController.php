<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller {
    use Helper;

    public function getHome() {

        $categories = Category::where('isActive', true)->get();
        $products = Product::where('isActive', true)->orderBy('sold', 'desc')->get()->take(8);

        $data = [
            'categories' => $categories,
            'products' => $products
        ];

        return $this->success($data);
    }

}
