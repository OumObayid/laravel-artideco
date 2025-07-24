<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'L’Atelier Déco')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --color-bg-main: #121212;
            --color-bg-secondary: #1e1e1e;
            --color-bg-card: #262626;
            --color-navbar: #000;

            --color-text-main: #f1f1f1;
            --color-text-muted: #bbb;
            --color-accent: #e3c34e;
            --color-accent-hover: #b28211;

            --font-main: 'Segoe UI', sans-serif;
        }

        @import url('https://fonts.googleapis.com/css2?family=Michroma&display=swap');

        body {
            background-color: var(--color-bg-main);
            font-family: var(--font-main);
            color: var(--color-text-main);
        }

        /* #global-loader {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        justify-content: center;
        align-items: center;
       } */


        .michromaTitle {
            font-family: "Michroma", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        .navbar {
            background-color: var(--color-navbar);
            border-bottom: 1px solid var(--color-accent)
        }

        .navbar-brand {
            font-weight: bold;
            color: var(--color-accent) !important;
            font-size: 2rem;
            letter-spacing: 1px;
        }

        .nav-link {
            color: var(--color-text-muted) !important;
            margin-right: 1rem;
            transition: color 0.2s;
        }

        .nav-link:hover {
            color: #fff !important;
        }

        .banner {
            background: url('/images/banner.JPG') center/cover no-repeat;
            height: 90vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .banner-overlay {
            background-color: rgba(0, 0, 0, 0.7);
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .banner-content {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .btn-custom {
            background-color: var(--color-accent);
            color: #000;
            border: none;
            transition: 0.3s ease;
        }

        .btn-custom:hover {
            background-color: var(--color-accent-hover);
            color: #fff;
        }

        .product-section {
            background-color: var(--color-bg-secondary);
            padding: 5rem 0;
        }

        .cardd {
            background-color: var(--color-bg-card);
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            color: var(--color-text-main);
            height: 100%;
        }

        .cardd:hover {
            transform: scale(1.03);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
        }

        .cardd-img-top {
            height: 230px;
            object-fit: cover;
        }

        footer {
            background-color: var(--color-navbar);
            color: var(--color-text-muted);
            padding: 40px 0;
            margin-top: 5rem;
        }

        footer a {
            color: var(--color-text-muted);
            text-decoration: none;
        }

        footer a:hover {
            color: var(--color-accent);
        }

        footer h5 {
            color: #fff;
        }
    </style>

</head>

<body>
    <nav class="navbar-expand-lg text-center">
        <div class="container">
            <a class="navbar-brand michromaTitle" href="{{ route('home') }}">L’Atelier Déco</a>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg ">
        <div class="container">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Accueil</a></li>

                @foreach ($categories as $category)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category.show', $category->id) }}">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach

                {{-- @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Connexion</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Inscription</a></li>
                @else                    
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-link nav-link" type="submit">Déconnexion</button>
                        </form>
                    </li>
                @endguest --}}
            </ul>

        </div>
    </nav>

    <main class="flex-grow-1">
        @yield('content')
    </main>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>L’Atelier Déco</h5>
                    <p>Décoration artisanale moderne pour un intérieur unique.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Navigation</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}">Accueil</a></li>
                        <li><a href="#produits">Produits</a></li>
                        <li><a href="{{ route('login') }}">Connexion</a></li>
                        <li><a href="{{ route('register') }}">Inscription</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Contact</h5>
                    <p>Email : contact@atelierdeco.com</p>
                    <p>Téléphone : +212 6 12 34 56 78</p>
                    <p>
                        <a href="#"><i class="bi bi-facebook me-2"></i></a>
                        <a href="#"><i class="bi bi-instagram me-2"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                    </p>
                </div>
            </div>
            <div class="text-center mt-4 border-top pt-3">
                &copy; {{ date('Y') }} L’Atelier Déco. Tous droits réservés.
            </div>
        </div>
    </footer>

    {{-- <div id="global-loader" class="d-flex">
        <div class="spinner-border text-light" role="status" style="width: 3rem; height: 3rem;">
            <span class="visually-hidden">Chargement...</span>
        </div>
    </div> --}}
    <div id="global-loader"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%;
     background-color: rgba(0,0,0,0.5); z-index: 9999; justify-content: center; align-items: center; display: none; flex-direction: column;"
        >
        <div class="spinner-border text-light" role="status" style="width: 3rem; height: 3rem;">
            <span class="visually-hidden">Chargement...</span>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Loader -->

    <script>
        // Afficher le loader sur tous les formulaires
        document.addEventListener("DOMContentLoaded", function() {
            const loader = document.getElementById("global-loader");

            document.querySelectorAll("form").forEach(form => {
                form.addEventListener("submit", function() {
                    loader.style.display = "flex";
                });
            });

            // Pour les liens ou boutons avec data-loader (ex. suppression AJAX)
            document.querySelectorAll('[data-loader]').forEach(btn => {
                btn.addEventListener('click', () => {
                    loader.style.display = "flex";
                });
            });
        });
    </script>
{{-- <script>
    document.addEventListener("DOMContentLoaded", function () {
        const loader = document.getElementById("global-loader");

        // ➤ Montrer le loader à la soumission d’un formulaire
        document.querySelectorAll("form").forEach(form => {
            form.addEventListener("submit", function () {
                loader.style.display = "flex";

                // ➤ Si on reste sur la page (validation JS ou AJAX),
                // on cache le loader après un délai de sécurité
                setTimeout(() => {
                    loader.style.display = "none";
                }, 8000); // 8 secondes par exemple (à adapter)
            });
        });

        // ➤ Pour les boutons avec data-loader (ex. suppression AJAX)
        document.querySelectorAll('[data-loader]').forEach(btn => {
            btn.addEventListener('click', () => {
                loader.style.display = "flex";

                // Cache aussi après un petit délai
                setTimeout(() => {
                    loader.style.display = "none";
                }, 8000);
            });
        });
    });
</script> --}}

</body>

</html>
