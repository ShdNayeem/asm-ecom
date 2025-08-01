<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountFormRequest;
use App\Models\Discount;
use Illuminate\Http\Request;
use Livewire\Attributes\Validate;

class DiscountController extends Controller
{
    public function index(){
        $discounts = Discount::orderBy('id','desc')->get();
        return view('admin.discount.index', compact('discounts'));
    }

    public function create(){
        return view('admin.discount.create');
    }

    public function store(DiscountFormRequest $request){

        $validatedData = $request->validated();

        $discount = new Discount();

        $discount->discount_name = $request->discount_name;
        $discount->discount_value = $request->discount_value;
        $discount->valid_from = $request->valid_from;
        $discount->valid_to = $request->valid_to;
        $discount->is_active = $request->is_active == true ? '1' : '0';

        $discount->save();
        return redirect('admin/discounts')->with('message', 'Discount Added Succesfully!');
    }

    public function edit($id){
        $discount = Discount::where('id', $id)->first();
        return view('admin.discount.edit', compact('discount'));
    }

    public function update(DiscountFormRequest $request, $id){
        $validatedData = $request->validated();

        $discount = Discount::where('id', $id)->first();

        $discount->discount_name = $request->discount_name;
        $discount->discount_value = $request->discount_value;
        $discount->valid_from = $request->valid_from;
        $discount->valid_to = $request->valid_to;
        $discount->is_active = $request->is_active == true ? '1' : '0';

        $discount->save();
        return redirect('admin/discounts')->with('message', 'Discount Updated Succesfully!');
    }

    public function destroy($id){
        $discount = Discount::where('id', $id)->first();

        $discount->delete();
        return redirect('admin/discounts')->with('message', 'Discount Deleted Succesfully');
    }
}
