<?php

namespace App;

use App\Notifications\ResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable
{
    use Notifiable;

    public function sendPasswordResetNotification($token)
    {
        // Your your own implementation.
        $this->notify(new ResetPassword($token));
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'ontology'
    ];

    protected $guarded = [
        'categoria'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /*************************** Relations **********************************/

    /**
     * Relation One To Many with ontologies.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ontologies()
    {
        return $this->hasMany(Ontology::class);
    }

    /**
     * Relation One to Many with thesaurus
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function thesaurus()
    {
        return $this->hasMany(Thesauru::class);
    }
}


