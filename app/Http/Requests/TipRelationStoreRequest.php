<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipRelationStoreRequest extends FormRequest
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
            'domain' => 'required|string|min:2|max:50',
            'range' => 'required|string|min:2|max:50',
            'similar_relation' => 'required|string|min:3|max:30',
            'cardinality' => 'required|numeric',
            'description' => 'required|min:1|max:500',
            'example_of_usage' => 'required|min:1|max:200|string',
            'imported_from' => 'required|url|max:255',
        ];
    }
}
