<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OntologyRelationStoreRequest extends FormRequest
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
            'domain' => 'required|string|min:3|max:50',
            'range' => 'required|string|min:3|max:50',
            'similar_relation' => 'string|min:3|max:50|nullable',
            'cardinality' => 'numeric|nullable',
            'definition' => 'min:1|max:500',
            'formal_definition' => 'nullable|max:500',
            'example_of_usage' => 'min:1|max:200|string',
            'imported_from' => 'max:255|nullable',
            'relation_id' => 'max:50|required|string',
            'label' => 'max:50|required|string',
            'synonyms' => 'max:50|nullable|string',
            'is_defined_by'  => 'max:50|nullable|string',
            'comments'  => 'max:255|nullable|string',
            'inverse_of'  => 'max:50|nullable|string',
            'subproperty_of'  => 'max:50|nullable|string',
            'superproperty_of'  => 'max:50|nullable|string',
            'ontology' => 'required'

        ];
    }
}
