<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // public function index()
    // {
    //     return response()->json(User::all());
    // }

    // Affichage des utilisateurs (Admin)
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    //edit profile
    public function editProfile()
    {

        return view('admin.profile.index', ['user' => auth()->user()]);
    }

    //update profile
    // public function updateProfile(Request $request)
    // {
    //     $user = auth()->user();

    //     $request->validate([
    //         'firstname' => 'required|string|max:255',
    //         'lastname'  => 'required|string|max:255',
    //         'email'     => 'required|email|unique:users,email,' . $user->id,
    //         'password'  => 'nullable|string|min:6|confirmed',
    //         'photo'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    //     ]);

    //     $data = $request->only(['firstname', 'lastname', 'email']);

    //     // Gestion image
    //     if ($request->hasFile('photo')) {
    //         $photoPath = $request->file('photo')->store('users', 'public');
    //         $data['photo'] = $photoPath;
    //     }

    //     // Mot de passe
    //     if ($request->filled('password')) {
    //         $data['password'] = Hash::make($request->password);
    //     }

    //     dd($user);

    //     $user->update($data);

    //     return redirect()->route('admin.profile.index')->with('success', 'Profil mis à jour avec succès.');
    // }
    public function updateProfile(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname'  => 'required|string|max:255',
        'email'     => 'required|email|unique:users,email,' . $user->id,
        'password'  => 'nullable|string|min:6|confirmed',
        'photo'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->only(['firstname', 'lastname', 'email']);

    // Gestion image
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('users', 'public');
        $data['photo'] = $photoPath;
    }

    // Mot de passe
    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }


    $user->update($data); 

    return redirect()->route('admin.profile.index')->with('success', 'Profil mis à jour avec succès.');
}



    // Suppression d'un utilisateur
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
