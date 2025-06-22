<?php

namespace App\Livewire\Admin\Brand;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use ReflectionFunctionAbstract;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $slug, $description, $brand_id ;

    public function rules(){

        return[
            'name' => 'required | string',
            'slug' => 'required | string',
            'description' => 'required'
        ];
    }

    public function resetInput(){
        $this->name = NULL;
        $this->slug = NULL;
        $this->description = NULL;
        $this->brand_id = NULL;
    }

    public function storeBrand(){
        $validatedData = $this->validate();
        Brand::create([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'description' => $this->description
        ]);
        session()->flash('message', 'Brand Added Successfully!');
        $this->dispatch ('close-modal');
        $this->resetInput();
    }

    public function closeModal(){
        $this->resetInput();
    }

    public function openModal(){
        $this->resetInput();
    }

    public function editBrand(int $brand_id){

        $this->brand_id = $brand_id;
        $brand = Brand::findOrFail($brand_id);
        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->description = $brand->description;
    }

    public function updateBrand(){
        $validatedData = $this->validate();
        Brand::findOrFail($this->brand_id)->update([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'description' => $this->description,
        ]);
        session()->flash('message', 'Brand Updated Successfully!');
        $this->dispatch('close-modal');
        $this->resetInput();
    }

    public function deleteBrand($brand_id){
        $this->brand_id = $brand_id;
    }

    public function destroyBrand(){
        Brand::findOrFail($this->brand_id)->delete();
        session()->flash('message', 'Brand Updated Successfully!');
        $this->dispatch('close-modal');
        $this->resetInput();
    }

    public function render()
    {
        $brands = Brand::orderBy('id', 'desc')->paginate(10);
        return view('livewire.admin.brand.index', compact('brands'))
        ->extends('layouts.admin')
        ->section('content');
    }
}
