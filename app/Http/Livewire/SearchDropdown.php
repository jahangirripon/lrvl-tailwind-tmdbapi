<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class SearchDropdown extends Component
{
    public $search = '';

    public function render()
    {
        $searchResults = [];
        if(strlen($this->search) >= 2) 
        {
            $searchResults = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/search/movie?query='.$this->search.'&api_key=f58db137115b5ace10ffab5475c4d2fb')
                ->json()['results'];
        }
        

        //dump($searchResults);

        return view('livewire.search-dropdown', [
            //'searchResults' => $searchResults
            'searchResults' => collect($searchResults)->take(5)
        ]);
    }
}
