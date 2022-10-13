<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Create extends Component
{

    public $noms = "";
    public $pays = "";
    public $sexe = "Masculin";
    public $telephone = "";
    public $email = "";
    public $login = "";
    public $password = "";
    public $password_confirmation = "";

    protected $rules = [

        'noms'=>'required|string',
            'pays'=>'required|string',
            'telephone'=>'required|numeric',
            'email'=>['required', 'email', 'unique:users,email'],
            'login'=>'required|alpha_num|unique:users,login',
            'password'=>'required|alpha_num',
            'password_confirmation'=>'same:password',
            

    ];

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function UserRegister()
    {
        $this->validate();

        if(session()->has('login') && session()->has('id'))
        {
            $parrain = User::where('id', session('id'))
            ->where('login', session('login'))->first();
            /**
             * si la requette retourne null donc aucun parrain qui porte ces informations
             * on affiche une erreur au filleul pour l'informer que le lien n'est pas
             * correct
             */

             if($parrain === NULL)
             {
                return back()->with('echec', "Ce lien n'est pas valide");
             }
            /**
             * on compte le nombre de filleul pour l'utilisateur.
             * s'il le total fait quatre on redirige l'utilisateur pour lu di que
             * le nombre de filleul pour ce utilisateur est atteint dans le cas contraire
             * le filleul pourra etre ajouter la liste de l'utilisateur qui porte ce id et 
             * cet login.
             */

            if($parrain->filleuls()->count()>=4)
            {
                return back()->with('echec', 'cet utilisateur a atteint sa limite');
            }

            session()->flash('idParrain',$parrain->id);
            

        }

        session()->regenerate();

        Auth::login(
            User::create([
            'noms'=>$this->noms,
            'pays'=>$this->pays,
            'tel'=> $this->telephone,
            'email'=> $this->email,
            'login'=> $this->login,
            'sexe'=>$this->sexe,
            'password'=>Hash::make($this->password),
            'type'=>'create',
            ]));

            $this->reset();
        return redirect()->route('compte');
    
    }
    public function render()
    {
        return view('livewire.create');
    }
}
