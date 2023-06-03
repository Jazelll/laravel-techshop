<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //LIST OF PRODUCTS
    public function index() {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            $heading = "SA HOME CONTROLLER TO";
            $products = Product::latest()->filter(request(['search']))->paginate(10);

            return view('products.index', compact('products', 'heading'));
        }
    }

    //SEARCH BAR FOR PRODUCTS
    public function search(Request $request)
    {
        $query = $request->input('search');
        $results = Product::filter($query)->paginate(5);

        return view('products.index', [
            "products" => $results
        ]);
    }


    //SHOW SINGLE PRODUCT
    public function show(Product $item){
        return view('products.show',[
            "item" => $item
        ] );
    }

    //CREATE PRODUCTS FORM
    public function create(){
        return view('products.create');
    }

    //STORE NEW PRODUCT
    public function store(Request $request) {
        $formFields = $request->validate([
            'product_name' => 'required',
            'description' => 'required',
            'unit_price' => 'required',
            'category' => ['required', 'not_in:Choose here'],
        ]);

        if($request->hasFile('image_url')){
            $formFields['image_url'] = $request->file('image_url')->store('images', 'public');
        }

        //---> SET user_id (creator of product)
        $formFields['user_id'] = auth()->id();

        Product::create($formFields);

        return redirect('/home')->with('success','New record saved succesfully!');
    }

    //EDIT PRODUCTS
    public function edit(Product $item) {
        return view('products.edit', [
            "item" => $item
        ]);
    }

    //UPDATE FORM
    public function update(Request $request, Product $item) {
        // validate the form data
        $formFields = $request->validate([
            'product_name' => 'required',
            'description' => 'required',
            'unit_price' => 'required',
            'category' => ['required', 'not_in:Choose here'],
        ]);
    
        // check if the file input field is not empty
        if($request->hasFile('image_url')){
            unset($formFields['image_url']);
            $formFields['image_url'] = $request->file('image_url')->store('images', 'public');
        }
        else {
            // if the file input field is empty, remove the image_url field from the form fields array
            unset($formFields['image_url']);
        }
    
        // update the product
        $item->update($formFields);
    
        // redirect back to the product listing page
        return redirect('/')->with('success', 'Product updated successfully!');
    }

    //DESTROY PRODUCTS
    public function destroy(Product $item){
        $item->delete();

        return redirect('/products/manage')->with('success','Record deleted!');
    }

    //MANAGE PRODUCTS
    public function manage(){
        return view('products.manage',[
            "heading" =>"Manage Products",
            "products" => Product::latest()->filter(request(['search']))->paginate(10)
        ] );
    }
}