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
        if($sortOrder === 'desc') {
            $sortOrder = 'desc';
        } else {
            $sortOrder = 'asc';
        }

        $products = Product::orderBy($sortBy, $sortOrder)->latest()->paginate(5);

        return view('index', compact('products'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
    

    public function show(Product $product)
    {
        return view('show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'details' => 'required',
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'details' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $inputs = $request->all();

        if($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = $profileImage;
        }

        Product::create($inputs);

        return redirect()->route('product.index')->with('success', 'Product created successfully');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('name', 'LIKE', "%($query)%")->orWhere('details', 'LIKE', "%($query)%")->get();

        return view('index', compact('products'));
    }
}
