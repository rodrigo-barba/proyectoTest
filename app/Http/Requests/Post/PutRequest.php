<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class PutRequest extends FormRequest
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
            //slug unico para la tabla y el campo, no debe tomar en cuenta el id del registro que se edita
            'slug' => 'required|min:5|max:500|unique:posts,slug,'.$this->route("post")->id,
            'content' => 'required|min:10',
            'category_id' => 'required|integer',
            'description' => 'required|min:10',
            'posted' => 'required',
            'image' => 'mimes:jpeg,jpg,png|max:10240'
        ];
    }
}
