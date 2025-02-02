<?php

namespace App\Http\Controllers;

use App\Models\Boutiques;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Process;
use RealRashid\SweetAlert\Facades\Alert;

class DeployController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'shop_name' => 'required|string|unique:boutiques,shop_name|min:3|max:30|regex:/^[a-zA-Z0-9\-]+$/'
        ]);

        $user = Auth::user();

        // Nettoyer et formater le nom de la boutique
        $shopName = strtolower(trim($request->shop_name));
        $shopName = preg_replace('/\s+/', '-', $shopName); // Remplace les espaces par des tirets
        $shopName = preg_replace('/[^a-z0-9\-]/', '', $shopName); // Supprime les caractères spéciaux
        $shopName = trim($shopName, '-'); // Supprime les tirets au début/fin

        if (empty($shopName)) {
            return back()->with('error', 'Nom de boutique invalide.');
        }

        $subdomain = "{$shopName}.eventchills.com";
        $deployPath = "/home/{user}/public_html/{$shopName}"; // Adapté à un hébergement mutualisé

        // Vérifier si la boutique existe déjà
        if (File::exists($deployPath)) {
            return back()->with('error', 'Ce nom de boutique est déjà utilisé.');
        }

        // Créer le dossier de la boutique
        File::makeDirectory($deployPath, 0755, true);

        // Générer un fichier index.html simple
        $htmlContent = "
        <html>
        <head><title>$shopName</title></head>
        <body>
            <h1>Bienvenue chez $shopName</h1>
            <p>Créé par : {$user->name}</p>
            <p>Email : {$user->email}</p>
            <p>Âge : {$user->age} ans</p>
        </body>
        </html>
    ";
        File::put("$deployPath/index.html", $htmlContent);

        // Sauvegarder la boutique en base de données
        Boutiques::create([
            'user_id' => $user->id,
            'shop_name' => $shopName,
            'subdomain' => $subdomain
        ]);

        return redirect()->route('dashboard')->with('success', "Site créé : http://$subdomain");
    }
}
