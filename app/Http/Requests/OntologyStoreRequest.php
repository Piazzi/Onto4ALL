<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OntologyStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'publication_date' => 'required|date',
            'last_uploaded' => 'required|date',
            'description' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'created_by' => 'nullable',
        ];
    }
}
