<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Filleul;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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
        session([
            'login'=>$login,
            'id'=>$id,
        ]);
        return redirect()->route('register');
      }

      /**
       * traitement inscription lien parrainage
       */

       public function TraitementRegister(Request $request, string $login, int $id)
       {

        $user = User::where('id', $id)
        
        ->where('login', $login)->first('id');

        if(!$user)
        {
            
            return redirect()->back()->with('echec', "le lien de parainnage que vous utilisez n'est pas valide");
        }

        if(User::where('parrain_id', $id)->count()==2)
        {
            return redirect()->back()->with('echec', "Cet parrain a atteint sa limite");
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
            'parrain_id'=>$user->id,
        ]);        

            session()->regenerate();

            Auth::login($parrain);            

            session()->flash('create', 'compte créé avec succès');
    
            return redirect()->intended('compte');
       }

       /**
        * gestion du filleul
        */

    private function gestionFilleul(int $id, int $authid)
    {
      

        /**
         * remplissage de la table filleul pour le nouveau inscrit
         * les filleuls inscrient par un lien auront pour niveau_id = 1
         */

       
         $filleul = Filleul::create([
            'id'=>$authid,
            'user_id'=>$id,
            'niveau_id'=>1,            
         ]);
         
         /**
          * recuperation du parrain de chaque filleul et ajout dans la table filleul
          */

          
          $parrain = Filleul::find($authid)->user;

          while($parrain!=null)
          {
            if(Filleul::find($parrain->id))
            {
                $parrain = Filleul::find($parrain->id)->user;

                $filleul = Filleul::create([
                    'id'=>$authid,
                    'user_id'=>$parrain->id,
                    'niveau_id'=>($filleul->niveau_id+1),
                ]);

                $parrain = Filleul::find($parrain->id);
            }else
            {
                $parrain = null;
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
    switch($niveau)
    {
        case 1:return ($user->investissement*20)/100;
        case 2:return ($user->investissement*3)/100;
        case 3: return ($user->investissement*2)/100;
        case 4: return $user->investissement/100;
        case 5: return ($user->investissement*0.5)/100;
        case 6: return ($user->investissement*0.35)/100;
        case 7: return ($user->investissement*0.25)/100;

    }
                    
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
           switch($niveau)
            {
                case 1: return $user->vente_mensuelle/100;
                case 2:
                case 3:
                case 4:
                case 5: return ($user->vente_mensuelle*0.25)/100;
                case 6:
                case 7 :($user->vente*0.1)/100;
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

        /**
         * Function pour calculer le nombre de personne à chaque niveau pour un parrain donné
         */

         public function compterFilleul(User $parrain)
         {
            /**recuperation des filleuls de l'user connecté 
             * 
            */
            $filleuls = $parrain->filleuls;

            $niveauActuel = 1;

            $niveau1 = $filleuls->niveau_id(1)->count();
            $niveau2 = $filleuls->niveau_id(2)->count();
            $niveau3 = $filleuls->niveau_id(3)->count();
            $niveau4 = $filleuls->niveau_id(4)->count();
            $niveau5 = $filleuls->niveau_id(5)->count();
            $niveau6 = $filleuls->niveau_id(6)->count();
            $niveau7 = $filleuls->niveau_id(7)->count();

            if($niveau1<=2)
            {
                $niveauActuel =1;
            }

            if($niveau1==2 && $niveau2>=1)
            {
                $niveauActuel=2;
            }

            //if()


         }

         private function recuperer(User $user)
         {
            return User::where('parrain_id', $user->id)->get();
         }
}
