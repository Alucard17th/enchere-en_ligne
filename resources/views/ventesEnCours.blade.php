@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Les enchères en cours
        </div>

        <div class="panel-body">

            @if(count($goods) > 0)
                @foreach ($goods->chunk(4) as $chunkgoods)
                    <div class="row">
                        @foreach ($chunkgoods as $good)
                            <div class="col-md-3 portfolio-item">
                                <div class="card clickable" onclick="location.href='{{ url("objet/$good->id") }}'">
                                    <img src="{{$good->getUrlPhoto()}}" alt="Avatar" class="card-img">
                                    <div class="card-body">
                                        <h4><b>{{ ucfirst($good->titre) }}</b></h4>
                                        <p>Prix actuel : {{ $good->getPrix() }} €</p>
                                        <p>Nombre d'enchères : {{ $good->encheres()->count() }}</p>
                                        <p>Termine dans : {{ $good->getTempsRestant() }}</p>
                                        <p>Vendeur : {{ ucfirst($good->vendeur->name) }} </a></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @else
                <ul class="list-group">
                    <li class="list-group-item">Aucun objet en vente actuellement.</li>
                </ul>
            @endif

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset("js/home.js") }}"></script>
@endsection