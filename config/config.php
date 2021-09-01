<?php

return [

    "encheres" => [
        "duree_jours" => env("DUREE_ENCHERE_JOURS", 7)
    ],

    "credits" => [
        "inscription" => env("NB_CREDITS_INSCRIPTION", 0),
        "vendre_objet" => env("NB_CREDITS_MISE_EN_VENTE", 1)
    ],
];
