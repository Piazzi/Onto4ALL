<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OntologyClass extends Model
{
    protected $fillable = [
        'name',
        'subclass',
        'synonyms',
        'example_of_usage',
        'imported_from',
        'definition',
        'formal_definition',
        'class_id',
        'label',
        'elucidation',
        'comments',
        'is_defined_by',
        'disjoint_with',
        'ontology'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $table = 'ontology-classes';

}
