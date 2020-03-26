<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OntologyRelation extends Model
{
    protected $fillable = [
       'name',
        'domain',
        'range',
        'similar_relation',
        'cardinality',
        'definition',
        'example_of_usage',
        'imported_from',
        'formal_definition',
        'relation_id',
        'label',
        'synonyms',
        'is_defined_by',
        'comments',
        'inverse_of',
        'subproperty_of',
        'superproperty_of',
        'ontology'

    ];

    protected $table = 'ontology-relations';
}
