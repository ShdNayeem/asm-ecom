<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
{
    $sliders = Slider::all();
    $newArrivals = Product::latest()->take(4)->get();
    $mobileCategory = Category::where('slug', 'mobile')->first();
    $mobileProducts = collect();
    if ($mobileCategory) {
        $mobileProducts = Product::where('category_id', $mobileCategory->id)->orderBy('id', 'desc')->take(4)->get();
    }

    return view('frontend.index', compact('sliders', 'newArrivals', 'mobileProducts', 'mobileCategory'));
}

    public function searchProducts(Request $request){
        if($request->term){
            $query = $request->get('term', '');
            $searchProducts = Product::where('name', 'LIKE', '%'.$query.'%')->latest()->paginate(15);

            $data = [];
            foreach($searchProducts as $item){
                $data[] = [
                    'value' => $item->name,
                    'id' => $item->id,
                    'url' => url('/collections/'.$item->category->slug.'/'.$item->slug)
                ];
            }
            if(count($data)){
                return $data;
            }
            else{
                return ['value' => 'No Result Found', 'id' => ''];
            }
            return view('frontend.pages.search', compact('searchProducts'));
        }
    }

    public function searchProductsDetails(Request $request){

        $searchingData = $request->input('search');
        $products = Product::where('name', 'like', '%'.$searchingData.'%')->first();

        $query = trim($request->get('search'));

        if ($query !== '') {
            $searchProducts = Product::where('name', 'LIKE', '%' . $query . '%')->latest()->paginate(15);
            return view('frontend.pages.search', compact('searchProducts'));
        }
        else {
            return redirect()->back()->with('status', 'Empty Search');
        }
    }

    public function categories(){
        $categories = Category::all();
        return view('frontend.collections.category.index', compact('categories'));
    }

    public function products($category_slug){
        $category = Category::where('slug', $category_slug)->first();
        if($category){
            $products = $category->products()->get();
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
            
            if($product){
                return view('frontend.collections.category.products.productView', compact('category','product'));
            }else{
            return redirect()->back();
        }
            
        }
        else{
            return redirect()->back();
        }
    }

    public function thankyou(){
        return view('frontend.thankyou');
    }

    public function newArrivals(){
        $newArrivals = Product::latest()->take(4)->get();
        return view('frontend.pages.new-arrival', compact('newArrivals'));
    }

    public function about(){
        return view('frontend.pages.about');
    }
    
    public function contact(){
        return view('frontend.pages.contact');
    }
}
