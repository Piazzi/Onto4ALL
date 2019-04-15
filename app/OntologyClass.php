<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OntologyClass extends Model
{
    protected $fillable = [
        'name','superclass','subclass','synonyms','example_of_usage','imported_from','definition','formal_definition'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $table = 'ontology-classes';

}
