<?php

use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usercontroller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::controller(usercontroller::class)->group(function()
{
    Route::get('/', 'index');

    Route::middleware(['auth'])->group(function()
    {
        
        Route::get('/compte', 'compte')->name('compte');

        Route::get('/logout', 'logout')->name('logout');

        Route::get('/listefilleuls', 'listefilleuls')->name('listefilleuls');

        Route::get('/historique', 'historique')->name('historique');        
    });

    Route::middleware('guest')->group(function()
    {
            Route::get('/register/{login}/{id}', 'register')
            ->whereAlphaNumeric('login')
            ->whereNumber('id')
            ->name('lregister');
    
    });
    
    Route::post('/tregister/{login}/{id}', 'TraitementRegister')
    ->whereAlphaNumeric('login')
    ->whereNumber('id')
    ->name('tregister');
});


/**
 * gestion pour l'admin
 */

 Route::controller(Admin::class)->group(function(){

    Route::middleware(['auth','Isadmin'])->group(function(){

        Route::get('/admin', 'index')->name('admin');

        Route::get('/admin/investir', 'investir')->name('investir');

        Route::get('/liste-utilisateur', 'listUtilisateur')->name('listUtilisateur');

        Route::get('/ajout-investissement', 'ajoutInvestissement')->name('ajoutInvestissement');

        Route::get('/retrait-investissement', 'retraitInvestissement')->name('retraitInvestissement');

        Route::get('/ajout-vente', 'ajoutVente')->name('ajoutVente');

        Route::get('/retrait-vente', 'retraitVente')->name('retraitVente');

        Route::post('/ajoutinvestissement', 'traitementAjoutinvestissement')->name('ajoutinvestissement');

        Route::post('/ajoutvente', 'traitementAjoutvente')->name('ajoutvente');

        Route::post('/retraitinvestissement', 'traitementRetraitInv')->name('retraitInv');

        Route::post('/retraitvente', 'traitementRetraitVente')->name('retraitvente');

    });
    
 });

 /**
  * alpinejs
  */

  Route::get('/alpine', [Admin::class, 'alpine']);
