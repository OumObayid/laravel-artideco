@extends('layouts.admin') {{-- ton layout AdminLTE --}}

@section('title', 'Mon Profil')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Modifier mon profil</h3>
            </div>

            <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="form-group">
                        <label>Prénom</label>
                        <input type="text" name="firstname" value="{{ old('firstname', $user->firstname) }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" name="lastname" value="{{ old('lastname', $user->lastname) }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Mot de passe (laisser vide si inchangé)</label>
                        <input type="password" name="password" class="form-control">
                        <input type="password" name="password_confirmation" class="form-control mt-2" placeholder="Confirmer mot de passe">
                    </div>

                    <div class="form-group">
                        <label>Photo de profil</label><br>
                        @if($user->photo)
                            <img src="{{ asset('storage/' . $user->photo) }}" class="img-circle mb-2" width="80" alt="Photo actuelle">
                        @endif
                        <input type="file" name="photo" class="form-control-file">
                    </div>
                </div>

                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
