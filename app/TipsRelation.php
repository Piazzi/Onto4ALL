<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipsRelation extends Model
{
    protected $fillable = [
        'domain','range','similar_relation','cardinality',
    ];
}
