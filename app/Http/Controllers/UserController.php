<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Ontology;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateUserRequest;


class UserController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count = Ontology::where('user_id', '=', Auth::user()->id)->count();
        $ontologies = Ontology::where('user_id', '=', Auth::user()->id)->latest()->get();
        $user = User::find(Auth::user()->id);
        $favouriteOntologies = Ontology::where('user_id', '=', Auth::user()->id)->where('favourite', '=', 1)->latest()->get();
        return view('user.profile', compact('count', 'user', 'ontologies', 'favouriteOntologies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {
        if($id != Auth::user()->id)
            return view('lockscreen');
        return view('user.settings');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $locale, $id)
    {
        if($id != Auth::user()->id)
            return view('lockscreen');
        $user = User::find($id);
        if ($request->email != Auth::user()->email) {
            $request->validate([
                'email' => 'required|string|email|max:255|unique:users'
            ]);
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        $user->save();
        return redirect()->route('user.edit', ['locale' => $locale, 'user'=> Auth::user()->id])->with('Sucess', 'Your account has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        if($id != Auth::user()->id)
            return view('lockscreen');
        $user = User::find($id);

        // Lembrar de adicionar onDelete Cascade no BD
        Ontology::where('user_id','=', $user->id)->delete();
        DB::table('ontology_user')->where('user_id','=', $user->id)->delete();
        //
        $user->delete();
        return redirect()->route('login', app()->getLocale());
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changePassword($locale, $id)
    {
        if($id != Auth::user()->id)
            return view('lockscreen');
        return view('user.change-password');
    }

    /**
     * Update the user password
     * @param Request $request
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request, $locale, $id)
    {
        if($id != Auth::user()->id)
            return view('lockscreen');
        $user = User::find($id);
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);
        $hashed = Hash::make($request->password);
        $user->password = $hashed;
        $user->save();
        return redirect()->route('user.edit', ['locale' => $locale, 'user'=> Auth::user()->id])->with('Sucess', 'Your password has been changed');

    }


}
