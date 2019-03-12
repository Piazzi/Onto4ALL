<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipClass extends Model
{
    protected $fillable = [
        'name','superclass','subclass','synonyms','example_of_usage','imported_from','description'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $table = 'tips_class';
}
