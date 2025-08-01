<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
// use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    public function index(){
        $products = Product::orderBy('id', 'desc')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create(){
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(ProductFormRequest $request){
        $validatedData = $request->validated();

        $category = Category::findOrFail($validatedData['category_id']);

       $product = $category->products()->create([
            'category_id' => $validatedData['category_id'],
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['slug']),
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'offer_price' => $validatedData['offer_price'],
            'msme_no' => $validatedData['msme_no'],
            'net_weight' => $validatedData['net_weight'],
            'batch_no' => $validatedData['batch_no'],
            'mfg_date' => $validatedData['mfg_date'],
            'mrp' => $validatedData['mrp'],
            'usp' => $validatedData['usp'],
        ]);

        if ($request->hasFile('image')) {
            $uploadPath = 'uploads/products/';
            
            $i = 1;
            foreach($request->file('image') as $imageFile){
                $extension = $imageFile->getClientOriginalExtension();
                $filename = time().$i++.'.'.$extension;
                $imageFile->move($uploadPath, $filename);
                $finalImagePathName = $uploadPath.$filename;

                $product->productImages()->create([
                'product_id' => $product->id,
                'image' => $finalImagePathName,
            ]);
            }
            
        }

        return redirect('/admin/products')->with('message', 'Product Added Successfully!');
    }

    public function edit(int $product_id){

        $categories = Category::all();
        $product = Product::findOrFail($product_id);
        return view('admin.products.edit', compact('categories', 'product'));
    }

    public function update(ProductFormRequest $request, int $product_id){
        $validatedData = $request->validated();

        $product = Category::findOrFail($validatedData['category_id'])
        ->products()->where('id' ,$product_id)->first();

        if($product){
            $product->update([
            'category_id' => $validatedData['category_id'],
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['slug']),
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'offer_price' => $validatedData['offer_price'],
            'msme_no' => $validatedData['msme_no'],
            'net_weight' => $validatedData['net_weight'],
            'batch_no' => $validatedData['batch_no'],
            'mfg_date' => $validatedData['mfg_date'],
            'mrp' => $validatedData['mrp'],
            'usp' => $validatedData['usp'],
            ]);

            if ($request->hasFile('image')) {
            $uploadPath = 'uploads/products/';
            
            $i = 1;
            foreach($request->file('image') as $imageFile){
                $extension = $imageFile->getClientOriginalExtension();
                $filename = time().$i++.'.'.$extension;
                $imageFile->move($uploadPath, $filename);
                $finalImagePathName = $uploadPath.$filename;

                $product->productImages()->create([
                'product_id' => $product->id,
                'image' => $finalImagePathName,
            ]);
            }
            
        }
        return redirect('/admin/products')->with('message', 'Product Updated Successfully!');
        
        }
        else{
            return redirect('admin/products')->with('message', 'No such Product Id is Found!');
        }
    }

    public function destroyImage(int $product_image_id){
        $productImage = ProductImage::findOrFail($product_image_id);
        if(File::exists($productImage->image)){
            File::delete($productImage->image);
        }
        $productImage->delete();
        return redirect()->back()->with('message', 'Product Image Deleted Successfully!');
    }

    public function destroy(int $product_id){

        $product = Product::findOrFail($product_id);

        if($product->productImages){
            foreach($product->productImages as $image){
                if(File::exists($image->image)){
                    File::delete($image->image);
                }
            }
        }
        $product->delete();
        return redirect('/admin/products')->with('message', 'Product Deleted with its all Images');
    }

    // Check if the product has images
    // if ($product->firstImage) {
    //     $imagePath = public_path('uploads/products/' . $product->firstImage->image);

    //     Delete the image file from folder if it exists
    //     if (File::exists($imagePath)) {
    //         File::delete($imagePath);
    //     }

    //     Optionally, delete the image record from DB
    //     $product->firstImage->delete();
    // }

    // Now delete the product
    // $product->delete();

    // return redirect('/admin/products')->with('message', 'Product Deleted Successfully!');
}