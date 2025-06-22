<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $sliders = Slider::all();
        return view('frontend.index', compact('sliders'));
    }

    public function categories(){
        $categories = Category::all();
        return view('frontend.collections.category.index', compact('categories'));
    }

    public function products($category_slug){
        $category = Category::where('slug', $category_slug)->first();
        if($category){
            $products = $category->products()->with('firstImage')->get();
            return view('frontend.collections.category.products.index', compact('products', 'category'));
        }
        else{
            return redirect()->back();
        }
    }

    public function productView(string $category_slug, string $product_slug){
        $category = Category::where('slug', $category_slug)->first();
        if($category){
            $product = $category->products()->where('slug', $product_slug)->first();
            $products = $category->products()->with('firstImage')->get();
            if($product){
                return view('frontend.collections.category.products.productView', compact('products', 'category', 'product'));
            }else{
            return redirect()->back();
        }
            
        }
        else{
            return redirect()->back();
        }
    }
    
}
