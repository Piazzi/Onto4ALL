<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Ontology;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\OntologyStoreRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notifications;
use App\Notifications\UserNotification;


class OntologyController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the user ontologies .
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ontologies = Ontology::where('user_id', '=', Auth::user()->id)->where('favourite', '=', 0)->latest()->paginate(10);
        $favouriteOntologies = Ontology::where('user_id', '=', Auth::user()->id)->where('favourite', '=', 1)->get();
        return view('ontologies.ontologies', compact('ontologies', 'favouriteOntologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ontologies.ontologies-store');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     */
    public static function store(Request $request)
    {
        $size = Ontology::where('user_id', '=', $request->user()->id)->where('favourite', '=', 0)->count();
        if ($size > 9) {
            Ontology::where('user_id', '=', $request->user()->id)->where('favourite', '=', 0)->orderBy('created_at', 'asc')->first()->delete();
        }
        $ontology = new Ontology();
        $ontology->name = $request->fileName ? $request->fileName : $request->name;
        $ontology->xml_string = $request->xml;
        $ontology->user_id = $request->user()->id;
        $ontology->created_by = $request->user()->name;
        $ontology->favourite = 0;
        $ontology->save();

        /// Updates the ontology if already exists in the ontology manager
        $ontologies = Ontology::where('user_id', $request->user()->id)->where('favourite', 1)->get();
        foreach ($ontologies as $savedOntology) {
            if ($savedOntology->name == $request->fileName) {
                $savedOntology->xml_string = $request->xml;
                $savedOntology->updated_at = $ontology->created_at;
                $savedOntology->save();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale, $id)
    {
        $ontology = Ontology::findOrFail($id);
        if ($ontology->userCanEdit())
            return view('ontologies.ontologies-show', compact('ontology'));
        else
            return view('lockscreen');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {
        $ontology = Ontology::findOrFail($id);
        $users = User::all();
        if ($ontology->userCanEdit())
            return view('ontologies.ontologies-edit', compact('ontology', 'id', 'users'));
        else
            return view('lockscreen');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OntologyStoreRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(OntologyStoreRequest $request, $locale, $id)
    {
        $ontology = Ontology::where('id', $id)->first();
        if ($ontology->userCanEdit()) {
            $ontology->update($request->all());
            $ontology->users()->sync($request->collaborators);
            return redirect()->route('ontologies.index', app()->getLocale())->with('Sucess', 'Your ontology has been updated with success');
        } else
            return view('lockscreen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $ontology = Ontology::find($id);
        if ($ontology->user_id == Auth::user()->id) {
            // Implementar onCascade no BD mais tarde
            DB::table('ontology_user')->where('ontology_id', $id)->delete();
            $ontology->delete();
        } else
            abort(403);
        return redirect()->route('ontologies.index', app()->getLocale())->with('Sucess', 'Your ontology has been deleted with success');
    }

    /**
     * Finds the ontology user and then download as a XML file.
     * @param Request $request
     * @return Response
     */
    public function downloadXML(Request $request)
    {
        // Implementar Autenticação mais tarde
        //$file = Ontology::where('user_id', '=', $request->userId)->where('id', '=', $request->ontologyId)->first();
        $file = Ontology::findOrFail($request->ontologyId);

        $response = Response::create($file->xml_string, 200);
        $response->header('Content-Type', 'text/xml');
        $response->header('Cache-Control', 'public');
        $response->header('Content-Description', 'File Transfer');
        $response->header('Content-Disposition', 'attachment; filename=' . $this->setFileExtension($file->name, '.xml') . '');
        $response->header('Content-Transfer-Encoding', 'binary');

        return $response;
    }

    /**
     * Change the status of the 'favourite' column
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveAsFavourite(Request $request)
    {
        $countOntologies = Ontology::where('user_id', '=', $request->userId)->where('favourite', '=', 1)->count();
        if ($countOntologies >= 5) {
            return redirect()->route('ontologies.index', app()->getLocale())->with('Error', 'You already have 5 ontologies marked as favourite.');
        }
        $ontology = Ontology::where('id', '=', $request->ontologyId)->where('user_id', '=', $request->userId)->first();
        $ontology->favourite = 1;
        $ontology->save();
        return redirect()->route('ontologies.index', app()->getLocale())->with('Sucess', 'Your ontology has been added to favorites');
    }

    /**
     * Unmark the favourite column from a ontology
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveAsNormal(Request $request)
    {
        $countOntologies = Ontology::where('user_id', '=', $request->userId)->where('favourite', '=', 0)->count();
        if ($countOntologies >= 10) {
            Ontology::where('user_id', '=', $request->user()->id)->where('favourite', '=', 0)->orderBy('created_at', 'asc')->first()->delete();
        }
        $ontology = Ontology::where('id', '=', $request->ontologyId)->where('user_id', '=', $request->userId)->first();
        $ontology->favourite = 0;
        $ontology->save();
        return redirect()->route('ontologies.index', app()->getLocale())->with('Sucess', 'Your ontology has been unmarked as favorite');
    }

    /**
     * Download the diagram to OWL format
     * @param Request $request
     * @return
     */
    public function downloadOWL(Request $request)
    {
        // Implementar Autentocação mais tarde
        //$file = Ontology::where('user_id', '=', $request->userId)->where('id', '=', $request->ontologyId)->first();
        $file = Ontology::findOrFail($request->ontologyId);
        $fileRequest = new Request();
        $fileRequest->setMethod('POST');
        $fileRequest->request->add(['xml' => $file->xml_string]);
        $fileRequest->request->add(['fileName' => $this->setFileExtension($file->name, '.owl')]);

        // converts the file to OWL
        $convertedFile = app('App\Http\Controllers\HomeController')->exportOWL($fileRequest)->getOriginalContent();

        $response = Response::create($convertedFile, 200);
        $response->header('Content-Type', 'text/xml');
        $response->header('Cache-Control', 'public');
        $response->header('Content-Description', 'File Transfer');
        $response->header('Content-Disposition', 'attachment; filename=' . $this->setFileExtension($file->name, '.owl') . '');
        $response->header('Content-Transfer-Encoding', 'binary');

        return $response;
    }

    /**
     * Update a existing ontology or create a new one
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateOrCreate(Request $request)
    {
        $ontology = Ontology::where('id', $request->id)->exists();
        if ($ontology) { 
            $ontology = Ontology::find($request->id);
            if ($ontology->userCanEdit()) {
                $ontology->update([
                    "name" => $request->name,
                    "xml_string" => $request->xml_string,
                    "publication_date" => $request->publication_date,
                    "last_uploaded" => $request->last_uploaded,
                    "description" => $request->description,
                    "link" => $request->link,
                    "favourite" => 0,
                    "domain" => $request->domain,
                    "general_purpose" => $request->general_purpose,
                    "profile_users" => $request->profile_users,
                    "intended_use" => $request->intended_use,
                    "type_of_ontology" => $request->type_of_ontology,
                    "degree_of_formality" => $request->degree_of_formality,
                    "scope" => $request->scope,
                    "competence_questions" => $request->competence_questions,
                    "namespace" => $request->namespace,
                ]);
            }
        } else {
            $ontology = Ontology::create([
                "name" => $request->name,
                "xml_string" => $request->xml_string,
                "publication_date" => $request->publication_date,
                "last_uploaded" => $request->last_uploaded,
                "description" => $request->description,
                "link" => $request->link,
                "user_id" => Auth::user()->id,
                "favourite" => 0,
                "domain" => $request->domain,
                "general_purpose" => $request->general_purpose,
                "profile_users" => $request->profile_users,
                "intended_use" => $request->intended_use,
                "type_of_ontology" => $request->type_of_ontology,
                "degree_of_formality" => $request->degree_of_formality,
                "scope" => $request->scope,
                "competence_questions" => $request->competence_questions,
                "namespace" => $request->namespace,
            ]);
        }
        /*
        $ontology = Ontology::updateOrCreate(
            ["id" => $request->id],
            ["name" => $request->name,
                "xml_string" => $request->xml_string,
                "publication_date" => $request->publication_date,
                "last_uploaded" => $request->last_uploaded,
                "description" => $request->description,
                "link" => $request->link,
                "user_id" => Auth::user()->id,
                "favourite" => 0,
                "domain" => $request->domain,
                "general_purpose" => $request->general_purpose,
                "profile_users" => $request->profile_users,
                "intended_use" => $request->intended_use,
                "type_of_ontology" => $request->type_of_ontology,
                "degree_of_formality" => $request->degree_of_formality,
                "scope" => $request->scope,
                "competence_questions" => $request->competence_questions,
            ]
        );*/

        $ontology->users()->sync($request->collaborators);
        Ontology::verifyOntologyLimit($request->user());

        foreach($ontology->users as $user){
            if($user->id != $ontology->user_id){
                $notification = ['title'=> __('New Ontology shared with you'), 'message'=> __('The user ') . $ontology->user->name . __(' shared with you the ontology ') . $ontology->name, 'from'=>$ontology->user->name, 'type'=> 'New Ontology Shared'];
                Mail::send(new \App\Mail\SharedOntologyMail($user, $ontology));
                $user->notify(new UserNotification($notification));
            }
        }
        return response()->json([
            "message-pt" => 'Todas as alterações foram salvas',
            "message-en" => 'All changes saved',
            "id" => $ontology->id,
        ]);
    }

    /**
     * Sets the file extension if not set before
     * @param $fileName
     * @param $extension
     * @return string
     */
    public function setFileExtension($fileName, $extension)
    {
        if (pathinfo($fileName, PATHINFO_EXTENSION) != $extension)
            $fileName = $fileName . $extension;
        return $fileName;
    }

    /**
     * Search for the diagram with the given id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function openOntologyInTheEditor(Request $request)
    {
        $ontology = Ontology::where('id', $request->id)->first();
        $ownerName = $ontology->user->name;
        if (Auth::user()->id == $ontology['user_id'] || $ontology->users->contains($request->user()->id)) {
            $response = array(
                'status' => 'success',
                'id' => $ontology['id'],
                'file' => $ontology['xml_string'],
                'name' => $ontology['name'],
                'publication_date' => $ontology['publication_date'],
                'last_uploaded' => $ontology['last_uploaded'],
                'description' => $ontology['description'],
                'link' => $ontology['link'],
                'user_id' => $ontology['user_id'],
                'favourite' => $ontology['favourite'],
                'domain' => $ontology['domain'],
                'general_purpose' => $ontology['general_purpose'],
                'profile_users' => $ontology['profile_users'],
                'intended_use' => $ontology['intended_use'],
                'type_of_ontology' => $ontology['type_of_ontology'],
                'degree_of_formality' => $ontology['degree_of_formality'],
                'scope' => $ontology['scope'],
                'competence_questions' => $ontology['competence_questions'],
                'collaborators' => $ontology->users->modelKeys(),
                'owner_name' => $ownerName
            );
            return response()->json($response);
            //return $ontology;
        } else {
            return 'Denied Access';
        }
    }

    /**
     * Returns the latest diagram edited by the user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function openLastUpdatedOntology(Request $request)
    {
        $ontology = Ontology::getLastUpdatedOntology($request->user());
        $ownerName = $ontology->user->name;
        if ($ontology == null) {
            $response = array([
                "text" => "Ontology Not Found"
            ]);
            return response()->json($response);
        } else {
            $response = array(
                'status' => 'success',
                'id' => $ontology['id'],
                'file' => $ontology['xml_string'],
                'name' => $ontology['name'],
                'publication_date' => $ontology['publication_date'],
                'last_uploaded' => $ontology['last_uploaded'],
                'description' => $ontology['description'],
                'link' => $ontology['link'],
                'user_id' => $ontology['user_id'],
                'favourite' => $ontology['favourite'],
                'domain' => $ontology['domain'],
                'general_purpose' => $ontology['general_purpose'],
                'profile_users' => $ontology['profile_users'],
                'intended_use' => $ontology['intended_use'],
                'type_of_ontology' => $ontology['type_of_ontology'],
                'degree_of_formality' => $ontology['degree_of_formality'],
                'scope' => $ontology['scope'],
                'competence_questions' => $ontology['competence_questions'],
                'collaborators' => $ontology->users->modelKeys(),
                'owner_name' => $ownerName
            );
            return response()->json($response);
        }
    }
}
