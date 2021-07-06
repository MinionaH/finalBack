<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Product;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $search='';
    public function render()
    {
        $searchResults= Product::where('name','like', '%'.$this->search.'%')->get();
        return view('livewire.search-dropdown', [
            'searchResults'=>collect($searchResults)->take(5),
        ]);
    }
}
