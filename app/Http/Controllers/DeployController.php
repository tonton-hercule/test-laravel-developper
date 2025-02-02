<?php

namespace App\Http\Controllers;

use App\Models\Boutiques;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DeployController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:boutiques,name|min:3|max:30|regex:/^[a-zA-Z0-9\-]+$/'
        ]);

        $user = Auth::user();

        // Nettoyer et formater le nom de la boutique
        $shopName = strtolower(trim($request->shop_name));
        $shopName = preg_replace('/\s+/', '-', $shopName); // Remplace les espaces par des tirets
        $shopName = preg_replace('/[^a-z0-9\-]/', '', $shopName); // Supprime les caractères spéciaux

        if (empty($shopName)) {
            return back()->with('error', 'Nom de boutique invalide.');
        }

        $subdomain = "{$shopName}.eventchills.com";
        
        $shop =  Boutiques::create([
            'user_id' => $user->id,
            'name' => $shopName,
            'subdomain' => $subdomain
        ]);

        return redirect()->away('http://' . $shop->name . '.eventchills.com');
    }


    public function show(Request $request)
    {
        $shopName = request()->route('subdomain');

        $shop = Boutiques::with('get_utilisateur')->where('name', $shopName)->first();
        
        if(empty($shop)){
            Alert::toast("Cette boutique n'existe pas !", 'error');

            return redirect()->route('login');
        }

        return view('shops.show', compact('shop'));
    }
}
