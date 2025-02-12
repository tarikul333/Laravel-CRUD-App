<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->get('sortBy', 'name');

        $sortOrder = $request->get('sort', 'asc');
        if ($sortOrder === 'desc') {
            $sortOrder = 'desc';
        } else {
            $sortOrder = 'asc';
        }

        $products = Product::orderBy($sortBy, $sortOrder)->latest()->paginate(5);

        return view('index', compact('products'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
    

    public function show($product_id)
    {
        $product = Product::where('product_id', $product_id)->firstOrFail();
        return view('show', compact('product'));
    }
    public function edit($product_id)
    {
        $product = Product::where('product_id', $product_id)->firstOrFail();
        return view('edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'details' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        $input = $request->all();

        if($image = $request->file('image')) {
            if($product->image && File::exists('images/' . $product->image)) {
                File::delete('images/' . $product->image); 
            }

            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = $profileImage;
        } else {
            unset($input['image']);
        }

        $product->update($input);

        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        if($product->image && File::exists('images/' . $product->image)) {
            File::delete('images/' . $product->image); 
        }

        $product->delete();

        return redirect()->route('product.index')->with('delete', 'Product deleted successfully');
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'details' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        $randomNumber = rand(10000, 99999);
        $input['product_id'] = $request->name . '-' . $randomNumber;

        if($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = $profileImage;
        }

        Product::create($input);

        return redirect()->route('product.index')->with('success', 'Product created successfully');
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('name', 'like', "$query%")
                            ->orWhere('details', 'like', "$query%")
                            ->get();

        return view('partials.table', compact('products'));
    }

}
