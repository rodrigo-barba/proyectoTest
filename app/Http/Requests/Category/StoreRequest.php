<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //util para cuando un usuario no tiene un rol autorizado
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        //valida los datos del formulario
        return [
            'title' => 'required|min:5|max:500',
            'slug' => 'required|min:5|max:500|unique:categories,slug'
        ];
    }
}
