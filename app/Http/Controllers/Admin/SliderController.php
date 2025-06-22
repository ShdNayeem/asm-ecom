<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderFormRequest;
use App\Models\Slider;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index(){
        $sliders = Slider::orderBy('id', 'desc')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create(){
        return view('admin.sliders.create');
    }

    public function store(SliderFormRequest $request){

        $validatedData = $request->validated();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploades/sliders/', $filename);
            $validatedData['image'] = "uploades/sliders/$filename";
        }

        Slider::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image']
        ]);
        return redirect('admin/sliders')->with('message', 'Slider Added Succesfully!');
    }

    public function edit(Slider $slider){
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(SliderFormRequest $request, Slider $slider){

        $validatedData = $request->validated();

        if($request->hasFile('image')){

            $destination = $slider->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploades/sliders/', $filename);
            $validatedData['image'] = "uploades/sliders/$filename";
        }

        Slider::where('id', $slider->id)->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'] ?? $slider->image
        ]);
        return redirect('admin/sliders')->with('message', 'Slider Updated Succesfully!');
    }

    public function destroy(Slider $slider)
    {
        if($slider->count > 0 ){
            $destination = $slider->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
        }
        $slider->delete();
        return redirect('admin/sliders')->with('message', 'Slider Deleted Succesfully!');
    }

}