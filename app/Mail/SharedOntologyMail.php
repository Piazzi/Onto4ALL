<?php

namespace App\Mail;

use App\User;
use App\Ontology;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class SharedOntologyMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    public $ontology, $creator, $created;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Ontology $ontology)
    {
        $this->user = $user;
        $this->ontology = $ontology;
        $this->creator = User::find($this->ontology->user_id)->name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   $this->subject('A new Ontology has been shared with you');
        $this->to($this->user->email, $this->user->name);
        return $this->markdown('email.ontology-shared-email',[
            'user' => $this->user,
            'ontology' => $this->ontology,
            'creator' => $this->creator
        ]);
    }
}
