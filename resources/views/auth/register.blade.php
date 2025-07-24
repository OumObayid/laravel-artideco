@extends('layouts.auth')

@section('title', 'Inscription')

@section('content')
    <h2 class="text-center mb-4">Créer un compte</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Prénom --}}
        <div class="mb-3">
            <label for="firstname" class="form-label">Prénom</label>
            <input type="text" id="firstname" name="firstname" class="form-control" value="{{ old('firstname') }}" required>
            @error('firstname') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        {{-- Nom --}}
        <div class="mb-3">
            <label for="lastname" class="form-label">Nom</label>
            <input type="text" id="lastname" name="lastname" class="form-control" value="{{ old('lastname') }}" required>
            @error('lastname') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Adresse e-mail</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        {{-- Mot de passe --}}
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" id="password" name="password" class="form-control" required>
            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">S’inscrire</button>

        <p class="text-center mt-3">
            Déjà un compte ? <a href="{{ route('login') }}">Se connecter</a>
        </p>
    </form>
@endsection
