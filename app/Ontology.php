<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ontology extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'publication_date',
        'last_uploaded',
        'description',
        'link',
        'user_id',
        'favourite',
        'domain',
        'general_purpose',
        'profile_users',
        'intended_use',
        'type_of_ontology',
        'degree_of_formality',
        'scope',
        'competence_questions',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'created_by',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $rules = [
        'name' => 'required|string',
        'publication_date' => 'nullable',
        'last_uploaded' => 'nullable',
        'description' => 'nullable',
        'link' => 'nullable',
        'created_by' => 'nullable',
        'favourite' => 'boolean'
    ];

    protected $table = 'ontologies';

    /*************************** Relations **********************************/

    /**
     * One to many relation with user Model.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
