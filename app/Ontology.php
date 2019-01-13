<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ontology extends Model
{
    protected $fillable = [
        'name', 'publication_date', 'last_uploaded', 'description', 'link',
    ];

    protected $hidden = [
        'created_by',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $table = 'ontologies';
}
