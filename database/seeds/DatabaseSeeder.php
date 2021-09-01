<?php

use Illuminate\Database\Seeder;
use App\Good;
use App\User;
use App\Enchere;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $factory = Faker\Factory::create('fr_FR');

        $vendeur = User::inRandomOrder()->select('id')->firstOrFail();
        $acheteur = User::inRandomOrder()->where('id', '!=', $vendeur->id)->select('id')->firstOrFail();
        
        $prix_depart = $factory->randomNumber(2);
        $date_fin = $factory->dateTimeBetween('now', '+7 days', 'Europe/Paris');
        $clone_date_fin = clone $date_fin;
        $date_debut = $clone_date_fin->modify("-7 days");

        $good = new Good();
        $chemin = Storage::disk("public")->put("photos", file_get_contents("https://www.clipartkey.com/mpngs/m/180-1802777_transparent-satelite-png-de-satelite-y-gps.png"));
        // On s'assure que le fichier a bien été enregistré dans l'espace de stockage
        if (Storage::disk("public")->exists($chemin)) {
            $good->photo = $chemin;
        } else {
            $good->photo = null;  // null == public/img_empty.png
        }
        $good->titre = ucfirst($factory->word);
        $good->description = $factory->paragraph;
        $good->prix_depart = $prix_depart;
        $good->prix_final = null;
        $good->date_debut = $date_debut;
        $good->date_fin = $date_fin;
        $good->acheteur_id = $acheteur->id;
        $good->vendeur_id = $vendeur->id;
        $good->saveOrFail();

        $nb_encheres = $factory->numberBetween(0, 5);
            for($j=0;$j < $nb_encheres; $j++){
                $encherisseur = User::inRandomOrder()
                        ->where('id', '!=', $vendeur->id)
                        ->select('id')->firstOrFail();
                
                $enchere = new Enchere();
                $enchere->acheteur_id = 1;
                $enchere->good_id = $good->id;
                $enchere->montant = $prix_depart + $j;
                $enchere->date_enchere = $date_debut;
                $enchere->saveOrFail();
            }
    }
}
