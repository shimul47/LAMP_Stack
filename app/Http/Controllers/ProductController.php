<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $total = Product::all()->count();
        $active = Product::where("status","active")->count();
        $inactive = Product::where("status","inactive")->count();
        return view("product.allProduct",["products"=> Product::orderBy('price','desc')->paginate(5),"total"=>$total,"active"=>$active,"inactive"=>$inactive]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("product.createProduct");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',

            
        ]);
        if($valid){
        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
        }
        Product::create([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'status' => $request->status,
            'image' => $path,

        ]);
            return redirect()->route("products.index");
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        return view("product.editProduct",["product"=> $product]);
    }
        
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {   
        $product = Product::findOrFail($id);

        if ($request->toggle_status == true) {
            $product->status = $product->status === 'active' ? 'inactive' : 'active';
            $product->save();
            return response()->json([
                'status' => $product->status,
                'count' => [
                    'total' => Product::count(),
                    'active' => Product::where("status", "active")->count(),
                    'inactive' => Product::where("status", "inactive")->count(),
                ]]);
        }
        
        $valid = $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);
        if($valid){
        $product->product_name = $request->product_name;
        $product->price = $request->price;

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $path = $request->file('image')->store('products', 'public');
            $product->image=$path;
        }

        $product->save();

        return response()->json([
            'success' => true,
            'data' => $product,
        ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::find($id)->delete();
        return redirect()->back();
    }
}
