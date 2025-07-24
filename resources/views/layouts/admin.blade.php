<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin')</title>

    {{-- ✅ FontAwesome + AdminLTE CSS en CDN --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <style>
        .info-box {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            border-radius: 0.5rem;
        }

        .info-box:hover {
            transform: scale(1.03);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .info-box-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            height: 100%;
            color: #fff;
            opacity: 0.8;
            transition: transform 0.3s ease;
        }

        .info-box:hover .info-box-icon {
            transform: scale(1.2);
            opacity: 1;
        }

        .gestIcon {
            transition: transform 0.3s ease;
        }

        .gestIcon:hover {
            transform: translateX(10px);
            /* pousse vers la droite */
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .navbar-nav .nav-item label {
            font-weight: 500;
            margin-bottom: 0;
            color: #333;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        {{-- 🔹 Barre de navigation --}}
        @include('admin.partials.navbar')

        {{-- 🔹 Barre latérale --}}
        @include('admin.partials.sidebar')

        {{-- 🔹 Contenu principal --}}
        <div class="content-wrapper p-3">
            @yield('content')
        </div>

    </div>

    {{-- ✅ JS CDN pour AdminLTE --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>

</html>
