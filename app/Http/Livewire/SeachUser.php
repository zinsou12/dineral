<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class SeachUser extends Component
{
    public $search = '1';

    protected $queryString = ['search'];

    public function updatedSearch($value)
    {
        $this->search = $value;
    }

    public function render()
    {
        
        return view('livewire.seach-user', ['resultat'=>User::where('noms', 'like', '%'.$this->search.'%')->get()]);
    }
}
