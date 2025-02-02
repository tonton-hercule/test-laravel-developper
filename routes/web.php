<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\DeployController;
use App\Models\Boutiques;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/custom-register', [CustomAuthController::class, 'register'])->name('custom-register');
Route::post('/custom-login', [CustomAuthController::class, 'login'])->name('custom-login');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    //Route::post('/deploy-boutique', [DeployController::class, 'store'])->name('deploy.store');
    // Route pour créer la boutique (stocke le nom en base de données)
    Route::post('/create-shop', function (Request $request) {
        $request->validate([
            'shop_name' => 'required|unique:boutiques,shop_name|regex:/^[a-z0-9-]+$/i'
        ]);

        $user = Auth::user();

        // Enregistre le shop_name dans la base
        $shop_name = strtolower(str_replace(' ', '-', $request->input('shop_name')));
        $subdomain = "http://{$user->shop_name}.eventchills.com";
        Boutiques::create([
            'user_id' => $user->id,
            'shop_name' => $shop_name,
            'subdomain' => $subdomain
        ]);
        
        Alert::toast("Votre boutique est prête : http://$subdomain", 'success');

        return redirect()->route('dashboard');
    })->name('deploy.store');

});


// Route pour les sous-domaines dynamiques
Route::domain('{subdomain}.eventchills.com')->group(function () {
    Route::get('/', function ($subdomain, Request $request) {
        // Vérifier si la boutique existe en base de données
        $shop = Boutiques::where('shop_name', $subdomain)->first();

        if (!$shop) {
            abort(404, "Boutique non trouvée !");
        }

        return view('shop.index', compact('shop'));
    });
});
