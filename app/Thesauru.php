<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thesauru extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'publication_date',
        'last_uploaded',
        'description',
        'user_id',
        'domain',
        'profile_users',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'created_by',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $rules = [
        'name' => 'required|string',
        'publication_date' => 'nullable',
        'last_uploaded' => 'nullable',
        'description' => 'nullable',
        'created_by' => 'nullable',
        'favourite' => 'boolean'
    ];

    protected $table = 'thesaurus';

    /*************************** Relations **********************************/

    /**
     * One to many relation with user Model.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
