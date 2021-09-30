<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OntologyClass extends Model
{
    use HasFactory;
    
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
        'ontology',
        'semi_formal_definition',
        'label_pt'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $table = 'ontology_classes';

}
