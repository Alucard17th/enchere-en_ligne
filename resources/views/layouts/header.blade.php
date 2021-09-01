<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                Projet DevWeb
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            @auth
                <ul class="nav navbar-nav">

                    <li class="dropdown @if(\Route::is('user.*')) active @endif">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Mon compte <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li class="@if(\Route::is('user.profil')) active @endif">
                                <a href="{{ url('/mon_profil') }}">Mon profil</a>
                            </li>
                            <!-- <li class="@if(\Route::is('user.ventes_en_cours')) active @endif">
                                <a href="{{ url('/mes_ventes_en_cours') }}">Mes ventes en cours</a>
                            </li>
                            <li class="@if(\Route::is('user.ventes_terminees')) active @endif">
                                <a href="{{ url('/mes_ventes_terminees') }}">Mes ventes terminées</a>
                            </li>
                            <li class="@if(\Route::is('user.achats')) active @endif">
                                <a href="{{ url('/mes_achats') }}">Mes achats</a>
                            </li>
                            <li class="@if(\Route::is('user.encheres_en_cours')) active @endif">
                                <a href="{{ url('/mes_encheres_en_cours') }}">Mes enchères en cours</a>
                            </li>
                            <li class="@if(\Route::is('user.recharger_mes_credits.*')) active @endif">
                                <a href="{{ url('/recharger_mes_credits') }}">Recharger mes crédits</a>
                            </li> -->
                            <li class="@if(\Route::is('user.ventes_terminees')) active @endif">
                                <a href="{{ url('/mes_stats') }}">Mes Statistiques</a>
                            </li>
                        </ul>
                    </li>
                    <li class="@if(\Route::is('form.mettre_en_vente.*')) active @endif"><a
                                href="{{ url('/mettre_en_vente') }}">Vendre un objet</a></li>
                    <li class="@if(\Route::is('all.ventes_en_cours')) active @endif"><a
                                href="{{ url('/ventes_en_cours') }}">Ventes en cours</a></li>

                </ul>
                <!-- <form class="navbar-form navbar-left" method="post" role="search" action="{{ url('/recherche') }}">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input type="text" class="form-control" name="recherche"
                               placeholder="Chercher un objet">
                        <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                    </div>

                </form> -->
        @endauth

        <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->

                @guest
                    <li><a href="{{ route('login') }}">Connexion</a></li>
                    <li><a href="{{ route('register') }}">Inscription</a></li>
                @else
                    <li class="not-clickable"><a>Bonjour {{ ucfirst(Auth::user()->username) }} !</a></li>
                    <!-- <li class="not-clickable ">
                        @php
                            $credit_actuel =  Auth::user()->credits;
                            $credit_1_vente = config("config.credits.vendre_objet");
                            $credit_2_ventes = $credit_1_vente*2;
                        @endphp
                        <a>Crédits <span class="badge @if($credit_actuel < $credit_1_vente) badge-danger
                            @elseif($credit_actuel < $credit_2_ventes) badge-warning
                            @else badge-success
                            @endif">{{ $credit_actuel }}</span></a>
                    </li> -->
                    <li class="clickable">
                        <a onclick="$('form#logout-form').submit();">Déconnexion</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>