<?php

namespace App\Observers;

use App\Models\Ontology;
use App\Models\OntologyClass;
use Illuminate\Routing\Route;

class OntologyObserver
{
    /**
     * Handle the ontology "created" event.
     *
     * @param  \App\Models\Ontology  $ontology
     * @return void
     */
    public function created(Ontology $ontology)
    {
    }

    /**
     * Handle the ontology "updated" event.
     *
     * @param  \App\Models\Ontology  $ontology
     * @return void
     */
    public function updated(Ontology $ontology)
    {
        //echo "<script>alert('a')</script>";
    }

    /**
     * Handle the ontology "deleted" event.
     *
     * @param  \App\Models\Ontology  $ontology
     * @return void
     */
    public function deleted(Ontology $ontology)
    {
    }

    /**
     * Handle the ontology "restored" event.
     *
     * @param  \App\Models\Ontology  $ontology
     * @return void
     */
    public function restored(Ontology $ontology)
    {
    }

    /**
     * Handle the ontology "force deleted" event.
     *
     * @param  \App\Models\Ontology  $ontology
     * @return void
     */
    public function forceDeleted(Ontology $ontology)
    {
    }
}
