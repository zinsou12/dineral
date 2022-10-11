<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Filleul;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\Rule;

class usercontroller extends Controller
{
    /**
     * Page du compte de l'utilisateur
     */
    public function compte()
    {

        /**
         * on verifie si une session arrive avec un id parrain
         */

         if(session()->has('idParrain'))
         {
            $this->gestionFilleul(session('idParrain'), Auth::id());
         }
        /** session de l'utilisateur connecté */
        
        
        $user = Auth::user();

        $this->calculGain($user);

        $this->calculGainvente($user);

        /**recuperation de la liste des filleuls pour l'utilisateur connecté */

        $filleuls = $user->filleuls;

        /**
         * total filleuls
         */

        $totalfilleuls = $filleuls->count();

        /**
         * niveau actuel
         */

         $niveauParrain = $filleuls->max('niveau_id');

         $users = ['user'=>$user,         
         'totalfilleuls'=>$totalfilleuls,
         'niveauParrain'=>$niveauParrain];

         
         
         return view('user/index', $users);
    }
    
    public function index()
    { 
        return redirect()->route('login');
    }

    /**
     * deconnection 
     */

     public function logout(Request $request)
     {
        Auth::logout();
 
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
 
        return redirect()->route('login')->with('logout', 'Vous êtes deconnecté');
     }

     /**
      * creation de compte via lien de parainage
      */

      /*public function register(Request $request, $login, $id)
      {
        $data = [
            'login'=>$login,
            'id'=>$id
        ];
        return view('livewire/inscriptions', $data);
      }*/

      /**
       * incription via lien parrainage
       */

      public function register(string $login, int $id)
      {
        return view('inscription', ['login'=>$login, 'id'=>$id]);
      }

      /**
       * traitement inscription lien parrainage
       */

       public function TraitementRegister(Request $request, string $login, int $id)
       {

        $user = User::where('id', $id)
        
        ->where('login', $login)->first();

        if(!$user)
        {
            
            return redirect()->back()->with('echec', "le lien de parainnage que vous utilisez n'est pas valide");
        }

        Validator::make($request->all(), [
            'noms' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'password' => ['required'],
            'telephone'=>'required|numeric|min:8',
            'pays'=>'required',
            'login' => [
                'required',
                'alpha_num',                
                'max:255',
                'unique:users,login',
            ],
            'password_confirmation'=>'same:password',

        ])->validate();


         $parrain = User::create([
            'noms' => $request->noms,
            'sexe' => $request->sexe,
            'tel' => $request->telephone,
            'pays' => $request->pays,
            'email' => $request->email,            
            'login' => $request->login,
            'password' => Hash::make($request->password),
        ]);        

            session()->regenerate();

            Auth::login($parrain);

            session()->flash('idParrain',$id);

            session()->flash('create', 'compte créé avec succès');
    
            return redirect()->intended('compte');
       }

       /**
        * gestion du filleul
        */

    private function gestionFilleul(int $id, int $authid)
    {
        /**recuperation du parrain de l'utilisteur qui vient de s'inscrire */
            
        $parrain = User::find($id);

        /**
         * recuperation des filleuls du parrain
         */

         $filleuls = $parrain->filleuls;

         /**
          * compter le nombre de filleuls
          */

          $totalFilleul = $filleuls->count();

          /**
           * verification si c'est superieur à 0
           */

           if($totalFilleul == 0)
           {
            /**
             * on cré un compte dans la table filleul avec niveau 1
             */
            return Filleul::create([
                'id'=>$authid,
                'user_id'=>$id,
                'niveau_id'=>1,
            ]);
           }
           else
           {
             /**
              * dans le cas contraire on recupere le maximum
              *des filleuls
              */

              $max = $filleuls->max('niveau_id');

              /**
               * on lance une verification sur le $max
               */
              if($max == 1)
              {
                /**
                 * On recupere le nombre de filleul au niveau 1
                */

                $totalfilleulniveau = Filleul::where('niveau_id', $max)->count();

                /**
                 * si le nombre total de filleul à ce niveau est inferieur à 2
                 */
                if($totalfilleulniveau<2)
                {
                    return Filleul::create([
                        'id'=>$authid,
                        'user_id'=>$id,
                        'niveau_id'=>1,
                    ]);
                }
                /**
                 * dans le cas contraire
                 */
                else
                {
                    $max +=1; 
                    Filleul::create([
                        'id'=>$authid,
                        'user_id'=>$id,
                        'niveau_id'=>$max,
                    ]);
                }
              }
              elseif($max == 2)
              {

                $totalfilleulniveau = Filleul::where('niveau_id', $max)->count();

                if($totalfilleulniveau<3)
                {
                    return  Filleul::create([
                        'id'=>$authid,
                        'user_id'=>$id,
                        'niveau_id'=>$max,
                    ]);
                }
                /**
                 * dans le cas contraire
                 */
                else
                {
                    $max +=1; 
                    return Filleul::create([
                        'id'=>$authid,
                        'user_id'=>$id,
                        'niveau_id'=>$max,
                    ]);
                }
              }
              elseif($max == 3)
              {
                $totalfilleulniveau = Filleul::where('niveau_id', $max)->count();

                if($totalfilleulniveau<7)
                {
                    return  Filleul::create([
                        'id'=>$authid,
                        'user_id'=>$id,
                        'niveau_id'=>$max,
                    ]);
                }
                /**
                 * dans le cas contraire
                 */
                else
                {
                    $max +=1; 
                    return  Filleul::create([
                        'id'=>$authid,
                        'user_id'=>$id,
                        'niveau_id'=>$max,
                    ]);
                }
              }
              elseif($max == 4)
              {
                $totalfilleulniveau = Filleul::where('niveau_id', $max)->count();

                if($totalfilleulniveau<15)
                {
                    return  Filleul::create([
                        'id'=>$authid,
                        'user_id'=>$id,
                        'niveau_id'=>$max,
                    ]);
                }
                /**
                 * dans le cas contraire
                 */
                else
                {
                    $max +=1; 
                    return Filleul::create([
                        'id'=>$authid,
                        'user_id'=>$id,
                        'niveau_id'=>$max,
                    ]);
                }
              }
              elseif($max == 5)
              {
                $totalfilleulniveau = Filleul::where('niveau_id', $max)->count();

                if($totalfilleulniveau<999)
                {
                    return Filleul::create([
                        'id'=>$authid,
                        'user_id'=>$id,
                        'niveau_id'=>$max,
                    ]);
                }
                /**
                 * dans le cas contraire
                 */
                else
                {
                    $max +=1; 
                    return Filleul::create([
                        'id'=>$authid,
                        'user_id'=>$id,
                        'niveau_id'=>$max,
                    ]);
                }
              }
              elseif($max == 6)
              {
                $totalfilleulniveau = Filleul::where('niveau_id', $max)->count();

                if($totalfilleulniveau<1047553)
                {
                    return Filleul::create([
                        'id'=>$authid,
                        'user_id'=>$id,
                        'niveau_id'=>$max,
                    ]);
                }
                /**
                 * dans le cas contraire
                 */
                else
                {
                    $max +=1; 
                    return  Filleul::create([
                        'id'=>$authid,
                        'user_id'=>$id,
                        'niveau_id'=>$max,
                    ]);
                }
              }
              else
              {
                $max = 7;

                $totalfilleulniveau = Filleul::where('niveau_id', $max)->count();

                
                return Filleul::create([
                        'id'=>$authid,
                        'user_id'=>$id,
                        'niveau_id'=>$max,
                    ]);
               
              }
              
           }
    }

      /**page liste des filleuls */

      public function listefilleuls()
      {
        /**
         * liste des filleuls
        */       
        
        return view('user/listef',['user'=>Auth::user()] );
      }

/**calcul du gain sur les filleuls
 * 
 */

 private function gainPourcentage(User $user, int $niveau)
 {
    /*
    calcul du pourcentage gagné sur chaque filleul en fonction de son
     niveau du filleull
    */
    return match($niveau)
    {
        1=>($user->investissement*20)/100,
        2=>($user->investissement*3)/100,
        3=>($user->investissement*2)/100,
        4=>$user->investissement/100,
        5=>($user->investissement*0.5)/100,
        6=>($user->investissement*0.35)/100,
        7=>($user->investissement*0.25)/100,

    };
                    
 }

 private function calculGain(User $user)
 {
    /**recuperation de tous les filleuls pour l'utilisateur connecté
     * 
     */

     $filleuls = $user->filleuls;

     /**je vais maintenant faire un filtrage en recuperant les filleuls dont le champ gain
      * status est false et statutinvestissement est à true
      */

      $filleulsfalse = $filleuls->where('statutgain', false)
                        ->where('statutinvestissement', true);

                        
    /**
     * verification que ça retourne une valeur au moins
     *  
    */    
        if($filleulsfalse->all()!=[])
        {
            /**je fais iterer sur le $filleulsfalse pour recuperer les infos neccessaire se trouvant 
       * dans la table parrain afin de faire un calcul
       */

       $sommegainfilleul = $filleulsfalse->map(function($filleul){

            $filleulfromuser = User::find($filleul->id);
            
            $filleul->statutgain = true;

            $filleul->save();

            return $this->gainPourcentage($filleulfromuser, $filleul->niveau_id); 
       });      

        /**
         * mise à jour du champ gain du parrain
         */       
        
        //$sommegainfilleul = $sommegainfilleul->toArray();
       
        $user->gains += $sommegainfilleul->sum();

        $user->save();
       }  
 }
 
        /**
        * calcul du pourcentage sur les ventes
        */

        private function ventePourcentage(User $user, int $niveau)
        {
            return match($niveau)
            {
                1=>$user->vente_mensuelle/100,
                2,3,4,5=>($user->vente_mensuelle*0.25)/100,
                6,7=>($user->vente*0.1)/100,
            };
        }

        private function calculGainvente(User $user)
        {
            /**
             * retournons la liste des filleuls d'un parrain
             */
            $filleuls = $user->filleuls;

            /**
             * filtrons cette liste en retournant les filleuls avec statutvent à true
             */

            $filleuls = $filleuls->where('statutinvestissement', true)
            ->where('statutvente', true);

            /**
             * nous allons iterer sur cette liste pour appliquer
             * un pourcentage selon le niveau de chaque filleul
             */

             if($filleuls->all()!=[])
             {
                $gainvente = $filleuls->map(function($filleul){

                    $filleulinfo = User::find($filleul->id);                    
    
                    $pourcentage = $this->ventePourcentage($filleulinfo, $filleul->niveau_id);
    
                    $filleul->statutvente = false;
    
                    $filleul->save();
    
                    return $pourcentage;
                 });
    
    
                 $user->gains_vente +=$gainvente->sum();
                 
                 $user->save();
             }

             
        }

        public function historique()
        {

            $historiques = Auth::user()->historiques;           
            
            return view('user/histo', ['user'=>Auth::user(), 'listHist'=>$historiques]);
        }
}
