<?php

namespace App\Http\Controllers;

use App\Models\Boutiques;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ShopDeploymentController extends Controller
{
    public function store(Request $request)
    {
        // Validation avec règles spécifiques pour Hostinger
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'unique:boutiques,name',
                'max:63',  // Limite DNS pour sous-domaines
                'regex:/^[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?$/' // Format valide pour sous-domaines
            ]
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $user = Auth::user();
            // Création de la boutique
            $shop = Boutiques::create([
                'name' => strtolower($request->name), // Force en minuscules
                'user_id' => $user->id,
            ]);

            // Redirection vers le nouveau sous-domaine
            return redirect()->away('https://' . $shop->name . '.eventchills.com');

        } catch (\Exception $e) {
            Alert::toast("Une erreur est survenue lors de la création de la boutique. " .$e->getMessage(), 'error');

            logger()->error('Erreur lors de la création de la boutique: ' . $e->getMessage());
            return back()->with('error', 'Une erreur est survenue lors de la création de la boutique.');
        }
    }

    public function validateSubdomain($name)
    {
        // Validation AJAX du nom de sous-domaine
        $validator = Validator::make(['name' => $name], [
            'name' => [
                'required',
                'string',
                'unique:boutiques,name',
                'max:63',
                'regex:/^[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?$/'
            ]
        ]);

        return response()->json([
            'valid' => !$validator->fails(),
            'errors' => $validator->errors()
        ]);
    }
}
