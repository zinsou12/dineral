<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Validator;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use Illuminate\Support\Facades\RateLimiter;
use App\Actions\Fortify\UpdateUserProfileInformation;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        /**
         * Affichage de la vue login
         */

        Fortify::loginView(function () {
            return view('index');
        });

        /**
         * Authentification de l'utilisateur
         */

         Fortify::authenticateUsing(function(Request $request){

           

           $validator =  Validator::make($request->all(),[
                'login'=>'required',
                'password'=>'required',
            ]);       

            
            if(Auth::attempt($validator->validate()))
            {
                
                session()->flash('success', true);

                return User::where('login', $request->login)->first();
      
            }

            if(Auth::attempt([
                'email'=>$request->login,
                'password'=>$request->password,
            ]))
            {
                session()->flash('success', true);
                return User::where('email', $request->login)->first();
            }
            
            if(Auth::guard('Isadmin')->attempt($validator->validate()))
            {
                session()->flash('success', true);

                return User::where('login', $request->login)->first();
            }

            /*if(Auth::attemptWhen($validator->validate(), function($user){
                if($user->admin)
                {
                    return $user;
                }
            }))
            {
                session()->flash('success', true);

                return User::where('login', $request->login)->first();
            }*/

           
         });
/**
 * page de création de compte
 */
         Fortify::registerView(function () {
            
            return view('inscriptions');
        });
    }
}
