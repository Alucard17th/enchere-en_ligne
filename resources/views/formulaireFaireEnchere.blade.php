<form id="formulaireFaireEnchere" class="form-horizontal" method="POST" action="{{ url("/objet/$good->id/enchere") }}">
    {{ csrf_field() }}
    <input type="hidden" name="good_id" value="{{ $good->id }}">

    <div class="form-group row">
        <label for="titre" class="col-md-4 control-label">Montant de l'offre actuelle</label>
        <div class="col-md-8">
            <div class="input-group">
                <input id="montant_actuel" type="number" class="form-control disabled" value="{{ $good->getPrix() }}"
                       disabled>
                <span class="input-group-addon" id="basic-addon2"> €</span>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="titre" class="col-md-4 control-label">Montant de votre offre</label>
        <div class="col-md-8">
            <div class="input-group">
                <!-- <input id="montant_enchere" type="number" min="{{ $good->getPrix() + 1 }}" step="1" class="form-control"
                       name="montant_enchere" value="{{ $good->getPrix() + 1 }}" required autofocus>$good->encheres()->count() -->
                       <input id="montant_enchere" type="number" min="{{ $good->getPrix() + 1 }}" step="any" class="form-control"
                       name="montant_enchere" value="{{ ($good->getPrix() * 10 / 100)+$good->getPrix() }}" required autofocus>
                <span class="input-group-addon" id="basic-addon2"> €</span>
            </div>
            <p class="help-block">Le montant de votre enchère doit être supérieur au montant de l'offre actuelle.</p>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                Valider l'enchère
            </button>
        </div>
    </div>
</form>

