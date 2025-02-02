<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class CustomAuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try {

            $user = new User();
            $user->setAttribute('name', $request->name);
            $user->setAttribute('age', $request->age);
            $user->setAttribute('email',  $request->email);
            $user->setAttribute('email_verified_at', new \DateTime());
            $user->setAttribute('password', Hash::make($request->password));
            $user->setAttribute('created_at', new \DateTime());
            $user->save();
            
            Alert::toast("Enregistrement effectué avec succès", 'success');

            return redirect()->route("login");
        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Login function
     */

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {            
            // redirection
            return redirect()->intended(route('dashboard'));
        }

        Alert::toast("Les informations de connexion ne sont pas valides", 'error');

        return redirect()->back();

    }
}
