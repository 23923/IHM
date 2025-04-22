<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; // Ajoutez cette ligne

class RegisterController extends Controller
{
    /**
     * Affiche le formulaire d'inscription
     */
    public function showRegistrationForm()
    {
        return view('authentification.register', [
            'roles' => ['candidat', 'formateur'] // Exclut admin
        ]);
    }

    /**
     * Traite l'inscription
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        if ($request->hasFile('cv')) {
            $this->handleCvUpload($request->file('cv'), $user);
        }

        // Connecter automatiquement l'utilisateur après inscription
        Auth::login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Valide les données d'inscription
     */
    protected function validator(array $data)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:candidat,formateur'],
        ];

        // Règles supplémentaires pour les formateurs
        if ($data['role'] === 'formateur') {
            $rules['specialite'] = ['required', 'string', 'max:255'];
            $rules['competence'] = ['required', 'string'];
            $rules['cv'] = ['required', 'file', 'mimes:pdf', 'max:2048'];
        }

        return Validator::make($data, $rules);
    }

    /**
     * Crée un nouvel utilisateur
     */
    protected function create(array $data)
    {
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ];

        // Données supplémentaires pour les formateurs
        if ($data['role'] === 'formateur') {
            $userData['specialite'] = $data['specialite'];
            $userData['competence'] = $data['competence'];
        }

        return User::create($userData);
    }

    /**
     * Gère l'upload du CV
     */
    protected function handleCvUpload($file, $user)
    {
        $path = $file->store('public/cvs');
        $user->update(['cv_path' => str_replace('public/', '', $path)]);
    }

    /**
     * Redirection après inscription réussie
     */
    protected function registered(Request $request, $user)
    {
        if ($user->role === 'formateur') {
            return redirect()->route('formations');
        }
        return redirect()->route('course');
    }

    /**
     * Chemin de redirection par défaut
     */
    public function redirectPath()
    {
        return '/list';
    }
}