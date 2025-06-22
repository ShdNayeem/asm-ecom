<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Requests\OfferFormRequest;

class OfferController extends Controller
{
    public function index(){
        $offers = Offer::orderBy('id', 'desc')->get();
        return view('admin.offers.index', compact('offers'));
    }

    public function create(){
        return view('admin.offers.create');
    }

    public function store(OfferFormRequest $request){

        $validatedData = $request->validated();

        $offer = new Offer;

        $offer->product_name = $request->product_name;
        $offer->description = $request->description;
        $offer->save();
        return redirect('admin/offers')->with('message', 'Offer Added Succesfully!');
    }

    public function edit(string $id)
    {
        $offer = Offer::where('id', $id)->first();
        return view('admin.offers.edit', compact('offer'));
    }

    public function update(OfferFormRequest $request, $id)
    {
        $validatedData = $request->validated();
        
        $offer = Offer::where('id', $id)->first();
        $offer->product_name = $request->product_name;
        $offer->description = $request->description;
        $offer->save();
        return redirect('admin/offers')->with('message', 'Offer Updated Succesfully!');
    }

    public function destroy(string $id)
    {
        $offer = Offer::where('id', $id)->first();
        $offer->delete();
        return redirect('admin/offers')->with('message', 'Offer Deleted Succesfully!');
    }
}
