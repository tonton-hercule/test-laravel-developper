<!DOCTYPE html>
<html lang="fr">
<head>
    <title>{{ $shop->shop_name }}</title>
</head>
<body>
    <h1>Bienvenue chez {{ $shop->shop_name }}</h1>
    <p>Créé par : {{ $shop->get_utilisateur->name }}</p>
    <p>Email : {{ $shop->get_utilisateur->email }}</p>
</body>
</html>
