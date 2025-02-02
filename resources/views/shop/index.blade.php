<!DOCTYPE html>
<html lang="fr">
<head>
    <title>{{ $shop->shop_name }}</title>
</head>
<body>
    <h1>Bienvenue chez {{ $shop->shop_name }}</h1>
    <p>Créé par : {{ $shop->name }}</p>
    <p>Email : {{ $shop->email }}</p>
</body>
</html>
