<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;



class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'inscription_token', 'inscription_confirmee', 'credits'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = 'users';
    public $timestamps = false;

    public function biensAchetes()
    {
        return $this->hasMany(Good::class, 'acheteur_id')->where("date_fin", '<=', Carbon::now());
    }

    /*public function ventesEnCours()
    {
        return $this->hasMany(Good::class, 'acheteur_id')->where("date_fin", '>', Carbon::now());
    }*/

    public function biensVendus()
    {
        return $this->hasMany(Good::class, 'vendeur_id')->where("date_fin", '<=', Carbon::now());
    }

    public function biensEnVente()
    {
        return $this->hasMany(Good::class, 'vendeur_id')->where("date_fin", '>', Carbon::now());
    }

    public function encheresVentesTerminees()
    {
        return $this->hasMany(Enchere::class, 'acheteur_id')->join("goods", "goods.id", '=', "encheres.good_id")->Where("date_fin", '<=', Carbon::now());
    }

    public function encheresEnCours()
    {
        return $this->hasMany(Enchere::class, 'acheteur_id')->join("goods", "goods.id", '=', "encheres.good_id")->Where("date_fin", '>', Carbon::now());
    }

    public function hasEnoughCredits()
    {
        return $this->credits >= config("config.credits.vendre_objet", 1);
    }

}
