<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OntologyRelation extends Model
{
    use HasFactory;

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
        'ontology',
        'semi_formal_definition',
        'label_pt'

    ];

    protected $table = 'ontology_relations';
}
