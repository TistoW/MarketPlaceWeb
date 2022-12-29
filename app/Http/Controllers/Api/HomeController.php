<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller {
    use Helper;

    public function getHome() {

        $categories = Category::where('isActive', true)->get();
        $slider = Slider::where('isActive', true)->get();
        $products = Product::where('isActive', true)
            ->with([
                'store:id,name',
                'store.address:id,tokoId,kota',
            ])
            ->select(['id', 'tokoId', 'name', 'price', 'sold', 'images'])
            ->orderBy('sold', 'desc')
            ->get()
            ->take(8);

        $data = [
            'categories' => $categories,
            'products' => $products,
            'sliders' => $slider
        ];

        return $this->success($data);
    }

}
