<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ontology extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'publication_date',
        'last_uploaded',
        'description',
        'link',
        'user_id',
        'favourite',
        'domain',
        'general_purpose',
        'profile_users',
        'intended_use',
        'type_of_ontology',
        'degree_of_formality',
        'scope',
        'competence_questions',
        'xml_string'
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
        'link' => 'nullable',
        'created_by' => 'nullable',
        'favourite' => 'boolean'
    ];

    protected $table = 'ontologies';

    /**
     * Removes the oldest user ontology
     * @param $user
     * @return
     */
    public static function removeOldestOntology($user)
    {
        return Ontology::where('user_id', '=', $user->id)->where('favourite', '=', 0)->orderBy('created_at', 'asc')->first()->delete();
    }

    /**
     * Verify if the user has more than 10 ontologies in the manager
     * @param $user
     */
    public static function verifyOntologyLimit($user)
    {
        $size = Ontology::where('user_id', '=', $user->id)->where('favourite', '=', 0)->count();
        if ($size > 10)
            Ontology::removeOldestOntology($user);
    }

    /**
     * Gets the Last Updated Ontology that the user has access
     *
     * @param $user
     * @return mixed
     */
    public static function getLastUpdatedOntology($user)
    {
        $ownedOntology = Ontology::where('user_id', $user->id)->latest('updated_at')->first();
        $sharedOntology = $user->ontologies->sortByDesc('updated_at')->first();
        if ($sharedOntology->updated_at > $ownedOntology->updated_at)
            return $sharedOntology;
        else
            return $ownedOntology;
    }


    /*************************** Relations **********************************/

    /**
     * One to many relation with user Model.
     * Returns the Owner of the ontology
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Many to many relation with User Model.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
