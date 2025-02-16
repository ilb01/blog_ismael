<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Myuppercase;
use App\Rules\Customlength;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'url_clean' => 'nullable|string|max:255|unique:posts,url_clean',
            'content' => 'required|string',
            'tags' => 'nullable|array', // Asegúrate de que 'tags' sea un array
            'tags.*' => 'exists:tags,id', // Valida que cada ID de tag exista en la base de datos
        ];
    }
    public function attibutes()
    {
        return [
            'title' => "Titol",
        ];
    }
    public function messages()
    {
        return [
            'title.required' => "You must specify a title",
            'title.unique' => ":input already exists in your database",
            'title.min' => "Minimusm 5 chars " . request('title'),
            'title.max' => "Maximsum 5 chars " . request('title'),
        ];
    }
}
