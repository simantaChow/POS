<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class ProductController extends Controller {
    function ProductPage()
    : View {
        return view( 'pages.dashboard.productPage' );
    }

    function CreateProduct( Request $request ) {
        $userID = $request->header( 'userID' );

        //prepare image file name and path
        $img = $request->file( 'img' );
        $time = time();
        $file_name = $img->getClientOriginalName();
        $img_name = "{$userID}-{$time}-{$file_name}";
        $img_url = "uploads/{$img_name}";

        //upload file
        $img->move( public_path( 'uploads' ), $img_name );

        //save to database
        return Product::create( [
            'user_id' => $userID,
            'category_id' => $request->input( 'category_id' ),
            'name' => $request->input( 'name' ),
            'price' => $request->input( 'price' ),
            'unit' => $request->input( 'unit' ),
            'img_url' => $img_url
        ] );
    }

    function DeleteProduct( Request $request ) {
        $userID = $request->header( 'userID' );
        $product_id = $request->input( 'id' );
        $filepath = $request->input( 'file_path' );
        File::delete( $filepath );
        return Product::where( 'id', '=', $product_id )->where( 'user_id', $userID )->delete();
    }

    function ProductByID( Request $request )
    : object {
        $userID = $request->header( 'userID' );
        $product_id = $request->input( 'product_id' );
        return Product::where( 'id', '=', $product_id )->where( 'user_id', $userID )->first();
    }

    function ProductList( Request $request ) {
        $userID = $request->header( 'userID' );
        return Product::where( 'user_id', $userID )->get();
    }

    function UpdateProduct( Request $request ) {
        $userID = $request->header( 'userID' );
        $product_id = $request->input( 'id' );
        if ( $request->hasFile( 'img' ) ) {
            //prepare image file name and path
            $img = $request->file( 'img' );
            $time = time();
            $file_name = $img->getClientOriginalName();
            $img_name = "{$userID}-{$time}-{$file_name}";
            $img_url = "uploads/{$img_name}";

            //upload file
            $img->move( public_path( 'uploads' ), $img_name );

            //delete old file
            $filepath = $request->input( 'file_path' );
            File::delete( $filepath );

            return Product::where( 'id', $product_id )->where( 'user_id', $userID )->update( [
                'category_id' => $request->input( 'category_id' ),
                'name' => $request->input( 'name' ),
                'price' => $request->input( 'price' ),
                'unit' => $request->input( 'unit' ),
                'img_url' => $img_url
            ] );
        } else {
            return Product::where( 'id', $product_id )->where( 'user_id', $userID )->update( [
                'name' => $request->input( 'name' ),
                'price' => $request->input( 'price' ),
                'unit' => $request->input( 'unit' ),
                'category_id' => $request->input( 'category_id' ),
            ] );
        }
    }
}
