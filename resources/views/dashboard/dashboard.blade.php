@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Bienvenue, {{ auth()->user()->firstname }} !</h2>
        <p>Vous êtes connecté en tant qu'utilisateur.</p>
    </div>
@endsection