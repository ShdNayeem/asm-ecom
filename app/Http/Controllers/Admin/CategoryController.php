<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Psy\CodeCleaner\FunctionContextPass;

class CategoryController extends Controller
{
    public function index(){
        return view('admin.category.index');
    }

    public function create(){
        return view('admin.category.create');
    }

    public function store(CategoryFormRequest $request){

        $validatedData = $request->validated();

        $category = new Category;

        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']); 
        $category->description = $validatedData['description'];

        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'-'.$ext;

            $file->move('uploades/category', $filename);
            $category->image = $filename;
        }

        $category->save();
        
        return redirect('admin/category')->with('message', 'Category Added Succesfully!');
    }

    public function edit(Category $category){
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryFormRequest $request, $category){

        $validatedData = $request->validated();

        $category = Category::findOrFail($category);

        $category->name = $validatedData['name'];
        $category->slug = $validatedData['slug'];
        $category->description = Str::slug($validatedData['description']); 

        if($request->hasFile('image')){

            $path = '/uploades/category/'.$category->image;
            if(File::exists($path)){
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'-'.$ext;

            $file->move('uploades/category', $filename);
            $category->image = $filename;
        }
        $category->update();
        
        return redirect('admin/category')->with('message', 'Category Edited Succesfully!');
    }

}