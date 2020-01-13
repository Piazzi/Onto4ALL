<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OntologyClassStoreRequest extends FormRequest
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
            'superclass' => 'nullable|string|min:1|max:50',
            'subclass' => 'nullable|string|min:1|max:50',
            'definition' => 'required|min:1|max:500',
            'synonyms' => 'nullable|min:1|max:20|string',
            'example_of_usage' => 'required|min:1|max:200|string',
            'imported_from' => 'max:255|nullable',
            'class_id' => 'max:50|required|string',
            'label' => 'max:50|required|string',
            'is_defined_by'  => 'max:50|nullable|string',
            'comments'  => 'max:255|nullable|string',
            'disjoint_with' => 'max:50|nullable|string',
            'elucidation' => 'max:50|nullable|string'
        ];
    }
}
