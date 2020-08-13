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
            'domain' => 'nullable|string|min:3|max:50',
            'range' => 'nullable|string|min:3|max:50',
            'similar_relation' => 'string|min:3|max:50|nullable',
            'cardinality' => 'numeric|nullable',
            'definition' => 'required|min:1|max:500',
            'formal_definition' => 'nullable|max:500',
            'example_of_usage' => 'nullable|min:1|max:200|string',
            'imported_from' => 'max:255|nullable',
            'relation_id' => 'min:7|max:7|required|string',
            'label' => 'max:50|required|string',
            'synonyms' => 'max:50|nullable|string',
            'is_defined_by'  => 'max:50|nullable|string',
            'comments'  => 'max:255|nullable|string',
            'inverse_of'  => 'max:50|nullable|string',
            'subproperty_of'  => 'max:50|nullable|string',
            'superproperty_of'  => 'max:50|nullable|string',
            'ontology' => 'required',
            'semi_formal_definition' => 'max:500|nullable|string',
            'label_pt' => 'max:50|nullable|string'

        ];
    }
}
