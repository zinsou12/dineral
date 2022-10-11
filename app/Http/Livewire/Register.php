<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Filleul;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;


class Register extends Component
{
    /**
     * declaration des propriétés
     */
    public $ids;

    public $login;

    public $users = [];

    /**
     * implementation de la validation du formulaire
     */
    protected $rules = [
            'users.noms' => ['required', 'string', 'max:255'],
            'users.email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'users.sexe'=>'required|in:Masculin,Feminin',
            'users.password' => ['required'],
        'users.tel'=>'required|numeric|min:8',
        'users.pays'=>'required',
        'users.login' => [
            'required',
            'alpha_num',                
            'max:255',
            "unique:users,login",
        ],
        'users.password_confirmation'=>'same:users.password',
    ];   

  
    /**
     * Validation automatique 
     */
    public function updated($property)
    {
        return $this->validateOnly($property);
    }

    /**
     * traitement du formulaire register
     */
    public function register()
    {     


        $user = User::where('id', $this->ids)
        
        ->where('login', $this->login)->first();

        if(!$user)
        {
            
            return redirect()->back()->with('echec', "le lien de parainnage que vous utilisez n'est pas valide");
        }

        $this->validate();
    
        unset($this->users['password_confirmation']);
        
        $this->users['password']=Hash::make($this->users['password']);

        $parrain = User::create($this->users);       

        $filleul = Filleul::where('user_id', $this->ids)->get();
         

         if($filleul->count()===0)
         {
             Filleul::create([
                 'id'=>$parrain->id,
                 'user_id'=>$this->ids,
                 'niveau_id'=>1,
             ]);
 
             Auth::login($parrain);
 
            session()->regenerate();

            session()->flash('create', 'compte créé avec succès');
     
            return redirect()->intended('compte');
         }else
         {
             $max = $filleul->max('niveau_id');

             if($max===1)
             {
                 $totalfilleulniveau = $filleul->where('niveau_id', $max)->count();
                 
                 
                 if($totalfilleulniveau<2)
                 {
                     Filleul::create([
                         'id'=>$parrain->id,
                         'user_id'=>$this->ids,
                         'niveau_id'=>$max,
                     ]);
 
                     Auth::login($parrain);
 
                    session()->regenerate();

                    session()->flash('create', 'compte créé avec succès');
            
                    return redirect()->intended('compte');
                 }
                 else
                 {
                    Filleul::create([
                        'id'=>$parrain->id,
                        'user_id'=>$this->ids,
                        'niveau_id'=>$max+1,
                    ]);

                    Auth::login($parrain);
 
                    session()->regenerate();

                    session()->flash('create', 'compte créé avec succès');
            
                    return redirect()->intended('compte');
                 }
             }elseif($max === 2)
             {
                 $totalfilleulniveau = $filleul->where('niveau_id', $max)->count();
                 
                 if($totalfilleulniveau<3)
                 {
                     Filleul::create([
                         'id'=>$parrain->id,
                         'user_id'=>$this->ids,
                         'niveau_id'=>$max,
                     ]);
 
                     Auth::login($parrain);
 
                    session()->regenerate();

                    session()->flash('create', 'compte créé avec succès');
            
                    return redirect()->intended('compte');
                 }
                 else
                 {
                    Filleul::create([
                        'id'=>$parrain->id,
                        'user_id'=>$this->ids,
                        'niveau_id'=>$max+1,
                    ]);

                    Auth::login($parrain);
 
                    session()->regenerate();

                    session()->flash('create', 'compte créé avec succès');
            
                    return redirect()->intended('compte');
                 }
             }
             elseif($max === 3)
             {
                 $totalfilleulniveau = $filleul->where('niveau_id', $max)->count();
                 
                 if($totalfilleulniveau<7)
                 {
                     Filleul::create([
                         'id'=>$parrain->id,
                         'user_id'=>$this->ids,
                         'niveau_id'=>$max,
                     ]);
 
                     Auth::login($parrain);
 
                    session()->regenerate();

                    session()->flash('create', 'compte créé avec succès');
            
                    return redirect()->intended('compte');
                 }
                 else
                 {
                    Filleul::create([
                        'id'=>$parrain->id,
                        'user_id'=>$this->ids,
                        'niveau_id'=>$max+1,
                    ]);

                    Auth::login($parrain);
 
                    session()->regenerate();

                    session()->flash('create', 'compte créé avec succès');
            
                    return redirect()->intended('compte');
                 }
             }
             elseif($max === 4)
             {
                 $totalfilleulniveau = $filleul->where('niveau_id', $max)->count();
                 
                 if($totalfilleulniveau<15)
                 {
                     Filleul::create([
                         'id'=>$parrain->id,
                         'user_id'=>$this->ids,
                         'niveau_id'=>$max,
                     ]);
 
                     Auth::login($parrain);
 
                    session()->regenerate();

                    session()->flash('create', 'compte créé avec succès');
            
                    return redirect()->intended('compte');
                 }
                 else
                 {
                    Filleul::create([
                        'id'=>$parrain->id,
                        'user_id'=>$this->ids,
                        'niveau_id'=>$max+1,
                    ]);

                    Auth::login($parrain);
 
                    session()->regenerate();

                    session()->flash('create', 'compte créé avec succès');
            
                    return redirect()->intended('compte');
                 }
             }
             elseif($max === 5)
             {
                 $totalfilleulniveau = $filleul->where('niveau_id', $max)->count();
                 
                 if($totalfilleulniveau<991)
                 {
                     Filleul::create([
                         'id'=>$parrain->id,
                         'user_id'=>$this->ids,
                         'niveau_id'=>$max,
                     ]);
 
                     Auth::login($parrain);
 
                    session()->regenerate();

                    session()->flash('create', 'compte créé avec succès');
            
                    return redirect()->intended('compte');
                 }
                 else
                 {
                    Filleul::create([
                        'id'=>$parrain->id,
                        'user_id'=>$this->ids,
                        'niveau_id'=>$max+1,
                    ]);

                    Auth::login($parrain);
 
                    session()->regenerate();

                    session()->flash('create', 'compte créé avec succès');
            
                    return redirect()->intended('compte');
                 }
             }
             elseif($max === 6)
             {
                 $totalfilleulniveau = $filleul->where('niveau_id', $max)->count();
                 
                 if($totalfilleulniveau<1047553)
                 {
                     Filleul::create([
                         'id'=>$parrain->id,
                         'user_id'=>$this->ids,
                         'niveau_id'=>$max,
                     ]);
 
                     Auth::login($parrain);
 
                    session()->regenerate();

                    session()->flash('create', 'compte créé avec succès');
            
                    return redirect()->intended('compte');
                 }
                 else
                 {
                    Filleul::create([
                        'id'=>$parrain->id,
                        'user_id'=>$this->ids,
                        'niveau_id'=>$max+1,
                    ]);

                    Auth::login($parrain);
 
                    session()->regenerate();

                    session()->flash('create', 'compte créé avec succès');
            
                    return redirect()->intended('compte');
                 }
             }
             elseif($max === 7)
             {
                 $totalfilleulniveau = $filleul->where('niveau_id', $max)->count();
                 
                 if($totalfilleulniveau>1047553)
                 {
                     Filleul::create([
                         'id'=>$parrain->id,
                         'user_id'=>$this->ids,
                         'niveau_id'=>$max,
                     ]);
                 }
 
                 Auth::login($parrain);
 
                session()->regenerate();

                session()->flash('create', 'compte créé avec succès');
        
                return redirect()->intended('compte');
             }
             
 
             
         }

       
    }

    /**
     * function pour connecter un nouveau utilisateur
     */

     private function authlogin(User $user)
     {
        Auth::login($user);
 
        session()->regenerate();

        session()->flash('create', 'compte créé avec succès');
     
        return redirect()->intended('compte');
     }

    /**
     * Affichage du formulaire register
     */
    public function render()
    {
        return view('livewire.register');
    }

    
}
