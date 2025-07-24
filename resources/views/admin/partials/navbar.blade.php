<nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
    {{-- Gauche : Lien vers Dashboard --}}
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                <i class="fas fa-home"></i> Accueil
            </a>
        </li>
    </ul>

    {{-- Droite : Profil + Déconnexion --}}
    <ul class="navbar-nav ml-auto align-items-center">
        @if(Auth::check())
            <li class="nav-item d-flex align-items-center">
                <label class="nav-link mb-0">{{ Auth::user()->firstname }}</label>

                {{-- Photo (optionnel) --}}
                @if(Auth::user()->photo)
                    <img src="{{ asset('storage/' . Auth::user()->photo) }}"
                         alt="Profil"
                         class="rounded-circle mx-2"
                         width="32" height="32">
                @endif

                {{-- Déconnexion --}}
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-link text-danger nav-link" type="submit">
                        <i class="fas fa-sign-out-alt"></i> Déconnexion
                    </button>
                </form>
            </li>
        @endif
    </ul>
</nav>
