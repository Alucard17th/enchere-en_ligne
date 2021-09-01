<?php

namespace App\Http\Controllers;

use App\Enchere;
use App\Good;
use App\Http\Requests\FormulaireFaireEncherePost;
use App\Http\Requests\FormulaireMiseEnVentePost;
use App\Http\Requests\RechercheObjetPost;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class GoodController extends Controller
{
    /**
     * Affiche le formulaire MiseEnVente
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function afficherFormulaireMiseEnVente()
    {
       
            return view("formulaireMiseEnVente");
       
    }

    /**
     * Traite le formulaire MiseEnvente
     * 
     * @param FormulaireMiseEnVentePost $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function traiterFormulaireMiseEnVente(FormulaireMiseEnVentePost $request)
    {
        // App/Requests/FormulaireMiseEnVentePost valide les données du formulaire avant d'arriver dans cette fonction
        
        // On crée un nouvel objet
        $good = new Good();
        $good->titre = $request->titre;
        $good->description = $request->description;
        $good->prix_depart = $request->prix_depart;
        $good->date_debut = Carbon::now();
        $good->date_fin = Carbon::now()->addDays(config("config.encheres.duree_jours"));
        $good->vendeur_id = Auth::user()->id;
        $good->categorie = $request->categorie;



        // Si une image valide a été envoyée depuis le formulaire, on enregistre l'image et on stocke le chemin dans l'objet
        if ($request->hasFile("photo") && $request->file("photo")->isValid()) {
            $chemin = Storage::disk("public")->put("photos", $request->file("photo"));
            // On s'assure que le fichier a bien été enregistré dans l'espace de stockage
            if (Storage::disk("public")->exists($chemin)) {
                $good->photo = $chemin;
            }
        }

        if (!$good->save()) {
            // Si une erreur est survenue on renvoie le message d'erreur
            $html = "<div class='alert alert-danger'>Une erreur lors de l'enregistrement est survenue. Veuillez essayer à nouveau.</div>";
            return response($html, 500);
        } else {
            // On retire les crédits au vendeur
            //$prix_credit = config("config.credits.vendre_objet", 1);

            $auth_user = Auth::user();
            //$auth_user->credits -= $prix_credit;
            $auth_user->save();

            $html = "<div class='alert alert-success'>Votre objet a bien été mis en vente.<a href='" . url('/objet/' . $good->id) . "' class='btn-link'>Cliquer ici pour voir l'objet</a></div>";
            return response($html, 200);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function afficherObjet($id)
    {
        $good = Good::find($id);

        // Si l'objet n'existe pas, on renvoie une erreur
        if (empty($good)) {
            abort(404);
        }

        $data = array(
            "good" => $good
        );
        return view("detailObjet", $data);
    }

    /**
     * @param RechercheObjetPost $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function traiterRechercheObjet(RechercheObjetPost $request)
    {
        $data = array(
            'recherche' => Good::where('titre', 'LIKE', '%' . $request->recherche . '%')
                ->where('date_fin', '>', Carbon::now())
                ->get()
        );
        return view('rechercheObjet', $data);
    }

    public function afficherVentesEnCours()
    {
        $data = array(
            'goods' => Good::where('date_fin', '>', Carbon::now())
                ->orderBy("date_debut")->get()
        );
        return view('ventesEnCours', $data);
    }

    public function afficherFormulaireFaireEnchere($id)
    {
        if (Auth::user()){
            $good = Good::find($id);

            if (empty($good)) {
                abort(404);
            }

            $data = array(
                'good' => $good
            );
            $view = View::make('formulaireFaireEnchere', $data)->render();

            $data["modal_title"] = "Encherir sur l'objet : $good->titre";
            $data["modal_body"] = $view;

            return view("layouts.modal", $data);
        }else{
            return view("layouts.modalLog");
        }
        

    }

    public function traiterFormulaireFaireEnchere(FormulaireFaireEncherePost $request)
    {
        $enchere = new Enchere();
        $enchere->montant = $request->montant_enchere;
        $enchere->good_id = $request->good_id;
        $enchere->acheteur_id = Auth::user()->id;
        $enchere->date_enchere = Carbon::now();
        $enchere->save();

        return redirect()->to("/objet/$request->good_id");
    }
}
