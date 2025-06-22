<?php

namespace App\Livewire\Frontend;

use App\Models\Wishlist;
use Illuminate\Foundation\Auth\User;
use Livewire\Component;

class WishlistShow extends Component
{

    public function removeWishlistItem(int $wishlistId){
        Wishlist::where('user_id', auth()->user()->id)->where('id', $wishlistId)->delete();
        $this->dispatch('wishlistUpdated');
        session()->flash('message', 'Wishlist Removed Successfully!');
        $this->dispatch('message',
                text : 'Wishlist Removed Successfully!',
                type : 'success',
                status : 200
            );
    }
    public function render()
    {
        $wishlist = Wishlist::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.wishlist-show', [
            'wishlist' => $wishlist
        ]);
    }
}