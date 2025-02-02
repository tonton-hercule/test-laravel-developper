<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>{{ $shop->shop_name }}</h1>
    <div>
        <p>Propriétaire : {{ $shop->get_utilisateur->name }}</p>
        <p>Email : {{ $shop->get_utilisateur->email }}</p>
        <p>Age : {{ $shop->get_utilisateur->age }}</p>
    </div>
</body>

</html>
