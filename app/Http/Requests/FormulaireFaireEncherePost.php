<?php

namespace App\Http\Requests;

use App\Rules\EnchereValide;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class FormulaireFaireEncherePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "good_id" => ['required', "exists:goods,id"],
            "montant_enchere" => ['required', 'numeric', new EnchereValide(request("good_id"))]
        ];
    }
}
