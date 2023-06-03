<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('products.index', [
            "heading" =>"THE TECH SPOT",
            "products" => Product::latest()->filter(request(['search']))->paginate(10)
            // "products" => Product::latest()->filter(request(['search']))->paginate(10)

        ] );
    }
    
}
