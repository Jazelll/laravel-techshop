<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Favorites;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //LIST OF PRODUCTS
    public function index() {
        $user = auth()->user();

        $favorites = Favorites::where('user_id', $user->id)->get();

        return view('favorites.favorites',[
            "favorites" => $favorites
        ] );
    }


    public function toggle($itemId) {
        $user = auth()->user();
        $favorite = Favorites::where('user_id', $user->id)
            ->where('product_id', $itemId)
            ->first();

        if ($favorite) {
            // Unlike the product
            $favorite->delete();
        } else {
            // Like the product
            Favorites::create([
                'user_id' => $user->id,
                'product_id' => $itemId,
            ]);
        }

        return redirect()->back();
    }

}
