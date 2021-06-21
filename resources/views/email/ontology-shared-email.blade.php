@component('mail::message')
    <h1>{{__('New Ontology!')}}</h1>
    <p>{{__('Hello,')}} {{ $user->name }}!
    <br>{{__('The user')}} {{ $creator }} {{__('shared with you the ontology')}} {{ $ontology->name }}.</p>
    <p>{{__('You can access it from the Ontology Manager menu on the Ontology Editor page or on the My Ontologies page')}} </p>
@endcomponent