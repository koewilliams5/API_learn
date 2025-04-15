<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreerPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //Je dois toujours autoriseé à true avant de continuer ici
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //obligations
            'titre' => 'required'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        //La reponse json à afficher
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => true,
            'message' => 'Erreur de validation',
            'ErrorList' => $validator -> errors(),
        ]));
    }

    public function messages()
    {
        return [
            //le message d'erreur
            'titre.required' => 'Le titre est obligatoire',
        ];
    }

}
