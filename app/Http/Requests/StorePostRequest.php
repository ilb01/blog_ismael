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
    public function rules(): array
    {
        return [
            'title' => ['required','unique:posts', new Customlength],
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
            'title.min' => "Minimusm 5 chars ". request ('title'),
            'title.max' => "Maximsum 5 chars ". request ('title'),
        ];
    }
}
