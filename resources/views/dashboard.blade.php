@extends('include.layout')

@section('title')
Dashboard
@endsection

@section('contenu')
    <div class="container mt-5">

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Error!</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <!-- Formulaire de création de boutique -->
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center">Création de boutique</h2>
                <form method="POST" action="{{ route('deploy.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="shop_name">Nom de la boutique</label>
                        <input type="text" class="form-control" name="shop_name" id="shop_name" placeholder="Entrez le nom de la boutique" required>
                    </div>
                    <button type="submit" class="btn btn-success btn-block mt-3">Déployer</button>
                </form>
            </div>

        </div>
    </div>


@endsection
