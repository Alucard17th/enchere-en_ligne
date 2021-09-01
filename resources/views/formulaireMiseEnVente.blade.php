@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Vendre un objet</h4>
                    </div>
                    <div class="panel-body">

                        @if(!empty($form_error))
                            <div class="alert alert-danger">
                                <span class="glyphicon glyphicon-remove"></span>
                                {{ $form_error }}
                            </div>
                            <hr>
                        @endif

                        @if(!empty($form_succes))
                            <div class="alert alert-success">
                                <span class="glyphicon glyphicon-ok"></span>
                                {{ $form_succes }}
                                <a href="{{ url("/objet/$good->id") }}" class="btn btn-success">Voir l'objet</a>
                            </div>
                            <hr>
                        @endif

                        {{-- Si le formulaire n'a pas déjà été envoyé et enregistré, on l'affiche --}}
                        @if(empty($form_succes))
                            <div class="alert alert-info">
                                <span class="glyphicon glyphicon-info-sign"></span>
                                Les objets sont mis en vente pour une durée
                                de {{ config("config.encheres.duree_jours") }} jours.
                            </div>
                            <hr>

                            <form id="formulaireMiseEnVente" class="form-horizontal" method="POST"
                                  action="{{ url('/mettre_en_vente') }}"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="form-group row">
                                    <label for="titre" class="col-md-4 control-label">Titre</label>
                                    <div class="col-md-8">
                                        <input id="titre" type="text" class="form-control" name="titre" required
                                               autofocus>
                                    </div>
                                </div>

                                <div class="form-group raw">
                                    <label for="description" class="col-md-4 control-label">Description de votre
                                        objet</label>
                                    <div class="col-md-8">
                                        <textarea id="description" class="form-control" name="description"
                                                  required></textarea>
                                    </div>
                                </div>

                                <div class="form-group raw">
                                    <label for="prix_depart" class="col-md-4 control-label">Prix de départ</label>
                                    <div class="col-md-8">
                                        <input id="prix_depart" type="number" class="form-control" name="prix_depart"
                                               required min="0" step="1">
                                    </div>
                                </div>

                                <div class="form-group raw">
                                    <label for="photo" class="col-md-4 control-label">Photo de l'objet</label>
                                    <div class="col-md-8">
                                        <input id="photo" type="file" class="btn btn-default btn-block" name="photo"
                                               required accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|images/*">
                                        <p class="help-block">Extensions autorisées : jpg, png, gif, bmp.</p>
                                    </div>
                                </div>

                                <div class="form-group raw">
                                    <label for="categorie" class="col-md-4 control-label">Catégorie</label>
                                    <div class="col-md-8">
                                        <select class="form-control" name="categorie" id="categorie">
                                            <option>Catégorie 1</option>
                                            <option>Catégorie 2</option>
                                            <option>Catégorie 3</option>
                                            <option>Catégorie 4</option>
                                            <option>Catégorie 5</option>
                                            <option>Catégorie 6</option>
                                            <option>Catégorie 7</option>
                                        </select>
                                    </div>
                                </div>

                                <hr>
                                @php
                                    $cout_credit = config("config.credits.vendre_objet");
                                    $credit_restant = Auth::user()->credits - $cout_credit;
                                @endphp
                                <hr>

                                <button id="btnSubmit" type="submit" class="btn btn-primary btn-block">
                                    Mettre en vente
                                </button>
                                <br>
                                <div id="response"></div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script>
        $("#formulaireMiseEnVente").submit(function(event){
            event.preventDefault();

            $.ajax({
                url: $(this).attr("action"),
                type: $(this).attr("method"),
                dataType: "JSON",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function (data, status) {
                    $("#response").html(data);
                },
                error: function (xhr, desc, err) {
                    // Pour des soucis d'affichage des balises HTML, on parse le texte en HTML avec jquery
                    var html = $.parseHTML(xhr.responseText);
                    $("#response").html(html);
                }
            });
        });
    </script>
@endsection