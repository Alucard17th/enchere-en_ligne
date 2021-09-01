@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Mon profil</h4>
        </div>

        <div class="panel-body">
            <h4>Mes informations</h4>
            <ul class="list-group">
                <li class="list-group-item">Nom : {{ ucfirst($user->name) }}</li>
                <!-- <li class="list-group-item">Prénom : {{ ucfirst($user->prenom) }}</li> -->
                <li class="list-group-item">E-mail : {{ strtolower($user->email) }}</li>
            </ul>

            <hr>

            <h4>Mes ventes et achats</h4>
            <ul class="list-group">
                <li class="list-group-item">Nombre d'objets mise en ventes : {{ $total }}</li>
                <li class="list-group-item">Nombre d'objets vendus : {{ $vendu }}</li>
                <li class="list-group-item">Nombre d'objets actuellement en ventes : {{ $envente }}</li>
                <li class="list-group-item">Nombre d'Enchères : {{ $enchere }}</li>
            </ul>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset("js/home.js") }}"></script>
@endsection



