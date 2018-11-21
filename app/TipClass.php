<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipClass extends Model
{
    protected $fillable = [
        'superclass','subclass','synonyms',
    ];

    protected $table = 'tips_class';
}
