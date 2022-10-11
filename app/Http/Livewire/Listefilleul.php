<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Contracts\Pagination\Paginator;

class Listefilleul extends Component
{

    use WithPagination;

    public $userAuth;

    protected $paginationTheme = 'bootstrap';

    public $listefilleul;

    /*public function mount()
    {
        $filleuls = $this->userAuth->filleuls()->paginate(5);        

        $this->listefilleul = $filleuls->map(function($filleul){

            return User::find($filleul->id);

        });

        
    }*/

    public function render()
    {
        $filleuls = $this->userAuth->filleuls()->latest()->paginate(100);        

        $this->listefilleul = $filleuls->map(function($filleul){

        return User::find($filleul->id);
        
    });

    return view('livewire.listefilleul',
     
        ['filleuls'=>$filleuls]);
}
}
