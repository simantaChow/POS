<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function CategoryPage()
    {
        return view('pages.dashboard.categoryPage');
    }

    function CategoryList(Request $request)
    {
        $user_id = $request->header('userID');
        return Category::where('user_id', $user_id)->get();
    }

    function CategoryCreate(Request $request)
    {
        $user_id = $request->header('userID');
        return Category::create([
            'name' => $request->input('name'),
            'user_id' => $user_id
        ]);
    }

    function CategoryDelete(Request $request)
    {
        $category_id = $request->input('id');
        $user_id = $request->header('userID');
        return Category::where('id', '=', $category_id)->where('user_id', '=', $user_id)->delete();
    }

    function CategoryUpdate(Request $request)
    {
        $category_id = $request->input('id');
        $user_id = $request->header('userID');
        return Category::where('id', '=', $category_id)->where('user_id', '=', $user_id)->update([
            'name' => $request->input('name'),
        ]);
    }
}
