<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {

        if(session()->has('login') and session()->has('id'))
        {
            $login = session('login');

            $id = session('id');
            
            $user = User::find($id)          
            ->where('login', $login)->first();

            session()->flash('idParrain', $id);

            
            
        }

        

        Validator::make($input, [
            'noms' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => [$this->passwordRules(), 'confirmed'],
            'telephone'=>'required|numeric|min:8',
            'pays'=>'required',
            'login' => [
                'required',
                'alpha_num',                
                'max:255',
                Rule::unique(User::class),
            ],
            'password_confirmation'=>'same:password',

        ])->validate();

        session()->flash('create', 'compte créé avec succès');
        
        return User::create([
            'noms' => $input['noms'],
            'sexe' => $input['sexe'],
            'tel' => $input['telephone'],
            'pays' => $input['pays'],
            'email' => $input['email'],            
            'login' => $input['login'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
