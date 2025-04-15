<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ModifierPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //toujours à true
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
