<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    function ProductPage(): View
    {
        return view('pages.dashboard.productPage.blade.php');
    }

    function CreateProduct(Request $request): JsonResponse
    {
        //prepare file name and path
        $user_id = $request->header('userID');
        $img = $request->file('img');
        $time = time();
        $file_name = $img->getClientOriginalName();
        $img_name = "{$user_id}-{$time}-{$file_name}";
        $img_url = "uploads/{$img_name}";

        //upload file
        $img->move(public_path('uploads'), $img_name);

        //save to database
        return Product::create([
            'user_id' => $request->input($user_id),
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'unit' => $request->input('unit'),
            'img_url' => $request->input('img_url')
        ]);
    }
}
