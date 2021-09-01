<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Enchere
 *
 * @property-read \App\User $acheteur
 * @property-read \App\Good $bien
 * @mixin \Eloquent
 * @property int $id
 * @property int $acheteur_id
 * @property int $good_id
 * @property float $montant
 * @property \Carbon\Carbon $date_enchere
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enchere whereAcheteurId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enchere whereDateEnchere($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enchere whereGoodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enchere whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enchere whereMontant($value)
 */
class Enchere extends Model
{
    protected $table = 'encheres';
    public $timestamps = false;

    protected $dates = [
      "date_enchere"
    ];

    public function acheteur()
    {
        return $this->belongsTo(User::class, "acheteur_id");
    }

    public function bien()
    {
        return $this->belongsTo(Good::class, "good_id");
    }
}
