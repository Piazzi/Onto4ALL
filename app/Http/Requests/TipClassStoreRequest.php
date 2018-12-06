<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipClassStoreRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:50',
            'superclass' => 'required|string|min:1|max:30',
            'subclass' => 'required|string|min:1|max:30',
            'description' => 'required|min:1|max:500',
            'synonyms' => 'required|min:1|max:20|string',
            'example_of_usage' => 'required|min:1|max:200|string',
            'imported_from' => 'required|url|max:255',
        ];
    }
}
