function afficherProfil() {
    $.ajax({
        type : 'GET',
        url : '/profil'
    }).done(function (response_html) {
        $("#contenu").append(response_html);
    }).fail(function (response) {
        alert("ERROR");
    })
    
}