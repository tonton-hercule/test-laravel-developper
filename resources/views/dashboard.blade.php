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

                <form method="POST" action="{{ route('deploy.store') }}" id="shopForm">
                    @csrf
                    <div>
                        <label for="name">Nom de la boutique</label>
                        <input 
                            type="text" 
                            name="name" 
                            class="form-control"
                            id="name" 
                            required 
                            pattern="^[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?$"
                            title="Utilisez uniquement des lettres minuscules, des chiffres et des tirets. Doit commencer et finir par une lettre ou un chiffre."
                        >
                        <span id="nameError" style="color: red;"></span>
                    </div>
                    <button type="submit" class="btn btn-success btn-block mt-3">Créer la boutique</button>
                </form>

            </div>

        </div>
    </div>

@endsection
