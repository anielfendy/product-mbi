<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Traits\UploadTrait;

class ProductController extends Controller
{
    use UploadTrait;

    public function index()
    {
        $products = Product::all();

        return view('product.index', compact('products'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        // Form validation
        $request->validate([
            'name'              =>  'required',
            'description'       =>  'required',
            'image'             =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Get current user
        $product = new Product;
        $product->name         = $request->input('name');
        $product->description  = $request->input('description');

        // Check if a profile image has been uploaded
        if ($request->has('image')) {
            // Get image file
            $image = $request->file('image');
            // Make a image name based on user name and current timestamp
            $name = str_slug($request->input('name')).'_'.time();
            // Define folder path
            $folder = '/uploads/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $product->image = $filePath;
        }

        $product->save();

        // Return user back and show a flash message
        return redirect()->back()->withStatus(__('Product successfully created.'));
    }

    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        // Form validation
        $request->validate([
            'name'              =>  'required',
            'description'       =>  'required',
            // 'image'             =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $product->name         = $request->input('name');
        $product->description  = $request->input('description');

        // Check if a profile image has been uploaded
        if ($request->has('image')) {
            // Get image file
            $image = $request->file('image');
            // Make a image name based on user name and current timestamp
            $name = str_slug($request->input('name')).'_'.time();
            // Define folder path
            $folder = '/uploads/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $product->image = $filePath;
        }

        $product->save();

        return redirect()->action('ProductController@index')->withStatus(__('Product successfully updated.'));
    }

    public function destroy(Product $product)
    {
        //
    }
}
