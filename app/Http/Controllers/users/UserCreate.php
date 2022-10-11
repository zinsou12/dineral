<?php

namespace App\Http\Controllers\users;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserCreate extends Controller
{
   

    public function register()
    {
        return view("register");
    }

    public function registerFilleul(string $login, int $id)
    {
        session(['login'=>$login, 'id'=>$id]);

        return redirect()->route('create');
    }

    public function traiteRegister(Request $request)
    {
        
        $rules = [
            'noms'=>'required|string',
            'pays'=>'required|string',
            'telephone'=>'required|numeric',
            'email'=>['required', 'email', 'unique:users,email'],
            'login'=>'required|alpha_num|unique:users,login',
            'password'=>'required|alpha_num',
            'password_confirmation'=>'same:password',
            'sexe'=>[Rule::in(['Masculin', 'feminin'])],
        ];
        $validator = Validator::make($request->all(), $rules)->validate();

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

        $request->session()->regenerate();

        Auth::login(
            User::create([
            'noms'=>$request->noms,
            'pays'=>$request->pays,
            'tel'=> $request->telephone,
            'email'=> $request->email,
            'login'=> $request->login,
            'sexe'=>$request->sexe,
            'password'=>Hash::make($request->password),
            ]));

        return redirect()->intended('compte');
    }
}
