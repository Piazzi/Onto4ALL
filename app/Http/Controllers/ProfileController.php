<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Ontology;
use App\Services\SocialFacebookAccountService;
use App\SocialFacebookAccount;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
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
        return view('profiles.profile', compact('count', 'user', 'ontologies', 'favouriteOntologies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if($id != Auth::user()->id)
            return view('lockscreen');
        return view('profiles.settings', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
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
        return redirect()->route('profile.edit', Auth::user()->id)->with('Sucess', 'Your account has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id != Auth::user()->id)
            return view('lockscreen');
        $user = User::find($id);
        Ontology::where('user_id','=', $user->id)->delete();
        SocialFacebookAccount::where('user_id', $user->id)->delete();
        $user->delete();
        return redirect()->route('login');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changePassword($id)
    {
        if($id != Auth::user()->id)
            return view('lockscreen');
        return view('profiles.change_password');
    }

    /**
     * Update the user password
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request, $id)
    {
        if($id != Auth::user()->id)
            return view('lockscreen');
        $user = User::find($id);
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);
        $hashed = Hash::make($request->password);
        $user->password = $hashed;
        $user->save();
        return redirect()->route('profile.edit', Auth::user()->id)->with('Sucess', 'Your password has been changed');

    }

}
