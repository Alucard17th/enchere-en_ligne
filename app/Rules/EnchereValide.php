<?php

namespace App\Rules;

use App\Good;
use Illuminate\Contracts\Validation\Rule;

class EnchereValide implements Rule
{
    public $good;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($good_id)
    {
        $this->good = Good::find($good_id);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(empty($this->good)){
           return false;
        }

        return $this->good->getPrix() < $value; //return true or false
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Le montant saisie est inférieur au prix de vente actuel.';
    }
}
