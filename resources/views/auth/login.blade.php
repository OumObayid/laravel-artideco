@extends('layouts.auth')

@section('title', 'Connexion')

@section('content')
    <h3 class="text-center mb-4">Connexion</h3>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3 position-relative">
            <label for="email" class="form-label">Email</label>
            <i class="bi bi-envelope-fill form-icon"></i>
            <input type="email" id="email" name="email" class="input-with-icon form-control" required value="{{ old('email') }}">
            @error('email') <div class="text-danger mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3 position-relative">
            <label for="password" class="form-label">Mot de passe</label>
            <i class="bi bi-lock-fill form-icon"></i>
            <input type="password" id="password" name="password" class="input-with-icon form-control" required>
            @error('password') <div class="text-danger mt-1">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">Se connecter</button>
    </form>

    <p class="text-center mt-3">
        Pas encore inscrit ? <a href="{{ route('register') }}">Créer un compte</a>
    </p>
@endsection
