@extends('include.layout')

@section('title')
Authentification
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
            <!-- Formulaire de Login -->
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center">Connexion</h2>
                <form method="POST" action="{{ route('custom-login')}}">
                    @csrf
                    <div class="form-group">
                        <label for="loginEmail">Adresse e-mail</label>
                        <input type="email" class="form-control" name="email" id="loginEmail" placeholder="Entrez votre e-mail" required>
                    </div>
                    <div class="form-group">
                        <label for="loginPassword">Mot de passe</label>
                        <input type="password" class="form-control" name="password" id="loginPassword"
                            placeholder="Entrez votre mot de passe" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-3">Se connecter</button>
                    <p class="text-center mt-3">Pas encore inscrit ? <a href="#registerModal"
                            data-toggle="modal">Inscrivez-vous ici</a></p>
                </form>
            </div>

            <!-- Modal d'inscription -->
            <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="registerModalLabel">Inscription</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('custom-register') }}" method="POST">
                                @csrf
                                <div class="form-group mb-2">
                                    <label for="registerName">Nom complet</label>
                                    <input type="text" class="form-control" id="registerName" name="name"
                                        placeholder="Entrez votre nom complet" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="registerEmail">Adresse e-mail</label>
                                    <input type="email" class="form-control" id="registerEmail" name="email"
                                        placeholder="Entrez votre e-mail" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="registerAge">Age</label>
                                    <input type="number" class="form-control" id="registerAge" name="age"
                                        placeholder="Entrez votre âge" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="registerPassword">Mot de passe</label>
                                    <input type="password" class="form-control" id="registerPassword" name="password"
                                        placeholder="Créez un mot de passe" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block mt-3">S'inscrire</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection
