<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Investir extends Component
{
    use WithPagination;
    
    protected $paginationTheme = "bootstrap";

    public $ids;

    public $liste = [];

    public function ajouter(User $user)
    {
        $this->liste[] = $user;        
    }

    public function supprimer(int $id)
    {
       unset($this->liste[$id]);       
    }

    public function render()
    {
        $users = User::where('id', '<>', $this->ids)->paginate(20);

        return view('livewire.investir', compact('users'));
    }
}
