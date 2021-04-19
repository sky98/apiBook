<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ISBN'  => 'required|numeric|min:1',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(){
        return [
            'ISBN.required' => 'The :attribute is required',
            'ISBN.numeric'  => 'The :attribute has been numeric',
            'ISBN.min'      => 'The :attribute has been minimun 1',
        ];
    }

    public function response(){
        if ($this->expectsJson()) {
            return new JsonResponse($errors, 422);
        }
    }
}
