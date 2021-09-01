<?php

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/home', function () {
//     return view('home');
// });


// Route::get('/home', function () {
//     if (\Illuminate\Support\Facades\Auth::check()) {
//         return redirect()->to("/ventes_en_cours");
//     } else {
//         return redirect()->to("/");
//     }
// });

Auth::routes();

Route::get('/ventes_en_cours', 'GoodController@afficherVentesEnCours')->name("all.ventes_en_cours");

Route::get('/objet/{id}', 'GoodController@afficherObjet')->name("objet.detail");

Route::get('/objet/{id}/enchere', 'GoodController@afficherFormulaireFaireEnchere')->name("form.faire_enchere.get");
Route::post('/objet/{id}/enchere', 'GoodController@traiterFormulaireFaireEnchere')->name("form.faire_enchere.post");

Route::get('/mettre_en_vente', 'GoodController@afficherFormulaireMiseEnVente')->name("form.mettre_en_vente.get");
Route::post('/mettre_en_vente', 'GoodController@traiterFormulaireMiseEnVente')->name("form.mettre_en_vente.post");
    
Route::get('/mes_stats', 'UserController@afficherStatsUtilisateur')->name("user.stats");
Route::get('/mon_profil', 'UserController@afficherMonProfil')->name("user.profil");

