<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Filleul;
use App\Models\Historique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Admin extends Controller
{
    /**
     * liste de tous les utilisateur inscrit sur la plateforme
     * 
     */

     public function index()
     {
        /**
         * recuperation de tous les utilisateurs sauf l'administrateur
         */

         $niveau = [1, 2, 3, 4, 5, 6, 7];

         foreach($niveau as $value)
         {
            $resultat['niveau'.$value] = $this->TotalFilleul($value);
         }        
         
         $UserConnected = Auth::user();

         $TotalUsers = User::count();

         $max = Filleul::max('niveau_id');

         $maxGain = User::max('gains');

         $maxVente = User::max('gains_vente');
         
         $users=['totalUsers'=>$TotalUsers, 'max'=>$max,

          'maxGain'=>$maxGain, 'maxVente'=>$maxVente,

          'resultat'=>$resultat,
        ];

        return view('admin/dashbord', $users);
     }

     /**
      * nombre de filleuls à chaque niveau
      */

      public function TotalFilleul(int $niveau_id)
      {

       return Filleul::where('niveau_id', $niveau_id)->count();        
      }

     /**
      * Ajouter des investissements
      */

      public function investir()
      {
        return view('admin/investir', ['user'=>Auth::user()]);
      }

      /**
       * alpinejs
       */

       public function alpine()
       {
        $colors = ['red', 'orang', 'yellow'];        

        return view('admin/alpine', compact('colors'));
       }

       /**
        * liste utilisteur
        */
       public function listUtilisateur()
       {

        $users = User::latest()->paginate(100);

        return view('admin/listef', compact('users'));
       }

       /**
        * ajout investissement
        */

        public function ajoutInvestissement()
        {
          return view('admin/ajoutinves');
        }

        /**
         * depot vente
         */

        public function ajoutVente()
        {
          return view('admin/depotvente');
        }

      /**
       * retrait investissement gain
       */
        public function retraitInvestissement()
        {
          return view('admin/retraitinvest');
        }
        /**
         * retrait vente
         */
        public function retraitVente()
        {
          return view('admin/retraitvente');
        }

        /**
         * operation ajout
         */

         public function traitementAjoutinvestissement(Request $request)
         {
            Validator::make($request->all(), [
              'idClient'=>'required|numeric',
              'montant'=>'required|numeric',
            ])->validate();

            /**
             * recuperation de l'utilisateur qui sera credité
             */

            $user = User::find($request->idClient);
            
            /**
             * si l'utilisateur existe je mets a jour son champs investissement par
             * le montant specifié
             */
            if($user)
            {
              $user->investissement = $request->montant;

              $user->save();
              /**
               * recuperation de l'utilisateur apres mise a jour de l'investissement
               */
              $user = User::find($request->idClient);

               /**
               * verification si l'utiliateur a au moins un parrain
               */
              if(Filleul::where('id', $request->idClient)->count()>0)
              {
                /**
                 * recuperation de la liste des parrains 
                 */

                 $parrains = Filleul::where('id', $request->idClient)->get(['niveau_id', 'user_id']);
                
                 /**
                 * je vais parcouru la liste des parrains et fait le calcul de gains
                 */
                 $parrains->map(function($parrain)use($user){

                  $parrainU = User::find($parrain->user_id);

                  $parrainU->gains +=$this->gainPourcentage($user, $parrain->niveau_id);
                 
                  $parrainU->save();
                 });
              }

              
             

              
            /**
             * retour sur la page du formulaire avec l'info investissement effectué
             */
             return redirect()->route('ajoutInvestissement')->with('success', 'Investissement effectué');
            }

            /**
             * dans le cas contraire raison de l'echec
             */

            return redirect()->route('ajoutInvestissement')->with('echec', "Cet utilisateur n'existe pas");
         }


         /**
          * traitement ajout vente
          */

          public function traitementAjoutVente(Request $request)
          {
            Validator::make($request->all(), [
              'idClient'=>'required|numeric',
              'montant'=>'required|numeric',
            ])->validate();
            
            /**
             * recuperation de l'utilisateurdont l'id a été fourni
             */
            $user = User::find($request->idClient);            

            /**
             * si l'utilisateur existe on met a jour son champ vente_mensuelle
             */
            if($user)
            {
              $user->vente_mensuelle = $request->montant;

              $user->save();

              $user = User::find($request->idClient);

              /**
               * on verifie si l'utilisateur à des parrains
               */
              if(Filleul::where('id', $request->idClient)->count()>0)
              {
                /**
                 * liste des parrains de l'utilisateur
                 */

                 $parrains = Filleul::where('id', $request->idClient)->get(['user_id', 'niveau_id']);

                 /**
                  * je vais parcourir cette liste et calculé le pourcentage gagné
                  *par chacun sur les vente
                  */

                  $parrains->map(function($parrain)use($user){
                    $parrainU = User::find($parrain->user_id);

                    $parrainU->gains_vente += $this->VentePourcentage($user, $parrain->niveau_id);

                    $parrainU->save();
                  });
              }

              Historique::create([
                'vente_mensuelle'=>$request->montant,
                'user_id'=>$request->idClient,
              ]);
             return redirect()->route('ajoutVente')->with('success', 'depot effectué');
            }

            return redirect()->route('ajoutVente')->with('echec', "Cet utilisateur n'existe pas");
          }


          public function traitementRetraitInv(Request $request)
          {
            Validator::make($request->all(), [
              'idClient'=>'required|numeric',
              'montant'=>'required|numeric',
            ])->validate();


            $user = User::find($request->idClient);

            

            if($user && $user->gains>=$request->montant)
            {
                $user->gains -=$request->montant;

                $user->save(); 

                Historique::create([

                  'retraitGain'=>$request->montant,

                  'user_id'=>$request->idClient,
                ]);

                return redirect()->route('retraitInvestissement')->with('success', "Retrait éffectué avec succès");
            }

            return redirect()->route('retraitInvestissement')->with('echec', "Veuillez verifiez le idclient ou le montant à retirer");
          }


          /**
           * retrait vente
           */

          public function traitementRetraitVente(Request $request)
          {
            Validator::make($request->all(), [
              'idClient'=>'required|numeric',
              'montant'=>'required|numeric',
            ])->validate();


            $user = User::find($request->idClient);

            

            if($user && $user->gains_vente >= $request->montant)
            {
                $user->gains_vente -= $request->montant;

                $user->save(); 

                Historique::create([
                  
                  'retraitVente'=>$request->montant,

                  'user_id'=>$request->idClient,
                ]);

                return redirect()->route('retraitVente')->with('success', "Retrait éffectué avec succès");
            }

            return redirect()->route('retraitVente')->with('echec', "Veuillez verifiez le idclient ou le montant à retirer");
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
    if($user->type == "register")
    {
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

    if($user->type == "create")
    {
            switch($niveau)
        {
            case 1:return ($user->investissement*20)/100;
            case 2:return ($user->investissement*7)/100;
            case 3: return ($user->investissement*3)/100;
            case 4: return $user->investissement*2/100;
            case 5: return ($user->investissement*1.5)/100;
            case 6: return ($user->investissement*1.2)/100;
            case 7: return ($user->investissement*1)/100;

        }
    }
                    
 }


 /**
        * calcul du pourcentage sur les ventes
        */

        private function ventePourcentage(User $user, int $niveau)
        {
          if($user->type == "register")
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
                  }
          }

          if($user->type == "create")
          {
                  switch($niveau)
              {
                  case 1: return $user->vente_mensuelle*4/100;
                  case 2: return $user->vente_mensuelle*2/100;
                  case 3: return $user->vente_mensuelle*1.5/100;
                  case 4:
                  case 5: 
                  case 6: 
                  case 7 :return $user->vente/100;
              }
          }
        }

}