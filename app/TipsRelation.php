<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipsRelation extends Model
{
    protected $fillable = [
       'name', 'domain','range','similar_relation','cardinality','definition','example_of_usage','imported_from',
    ];
}
