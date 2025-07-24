<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Authentification')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Bootstrap & Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Style personnalisé --}}
    <style>
        body {
            background: #121212;
            font-family: 'Segoe UI', sans-serif;
            color: #f1f1f1;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-box {
            background-color: #1e1e1e;
            padding: 2rem;
            margin: 1rem;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.4);
            width: 100%;
            max-width: 400px;
        }

        .auth-box .form-control {
            background-color: #262626;
            border: 1px solid #444;
            color: #f1f1f1;
        }

        .auth-box .form-control:focus {
            background-color: #262626;
            color: #fff;
            border-color: #e3c34e;
            box-shadow: none;
        }

        .auth-box .btn-primary {
            background-color: #e3c34e;
            border-color: #e3c34e;
            color: #000;
        }

        .auth-box .btn-primary:hover {
            background-color: #b28211;
            border-color: #b28211;
            color: #fff;
        }

        a {
            color: #e3c34e;
        }

        a:hover {
            color: #b28211;
        }
        .form-icon{
          position: absolute;
          top: 50%;
          transform: translate(-50%);
          left: 18px;
          font-size: 1rem;
          
        }
        .input-with-icon{
            padding-left: 2.2rem;
        }

    </style>
</head>
<body>
    <div class="auth-box">
        @yield('content')
    </div>
</body>
</html>
