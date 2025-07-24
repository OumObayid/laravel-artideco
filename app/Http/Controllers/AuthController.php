<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Affiche le formulaire de connexion.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Affiche le formulaire d'inscription.
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Traitement de l'inscription.
     */
    public function register(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname'  => 'required|string|max:255',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|string|min:6',
        ]);

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname'  => $request->lastname,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Utilisateur créé avec succès'], 201);
        }

        return redirect()->route('login')->with('success', 'Compte créé avec succès. Connectez-vous !');
    }

    /**
     * Traitement de la connexion.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials)) {
            return $request->expectsJson()
                ? response()->json(['message' => 'Identifiants incorrects'], 401)
                : back()->with('error', 'Email ou mot de passe incorrect.');
        }

        $user = Auth::user();

        if ($request->expectsJson()) {
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json(['token' => $token]);
        }

        return redirect()->route($user->role === 'admin' ? 'admin.dashboard' : 'dashboard');
    }

    /**
     * Déconnexion de l'utilisateur.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return $request->expectsJson()
            ? response()->json(['message' => 'Déconnexion réussie'])
            : redirect()->route('login');
    }

    /**
     * Création d’un utilisateur (ex: depuis le dashboard admin).
     */
    public function store(UserRequest $request)
    {
        User::create($request->validated());

        return redirect()->back()->with('success', 'Utilisateur créé avec succès');
    }

    /**
     * Retourne les infos de l’utilisateur connecté (API).
     */
    public function user()
    {
        return response()->json(Auth::user());
    }
}
