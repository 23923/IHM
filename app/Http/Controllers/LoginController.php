<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('authentification.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            return $this->authenticated($request, Auth::user());
        }

        return back()->withErrors([
            'email' => 'Identifiants incorrects.',
        ])->onlyInput('email');
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->isAdmin()) {
            return redirect()->route('list');
        }
        if ($user->isFormateur()) {
            return redirect()->route('formations');
        }
      

        return redirect()->route('course');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
    public function candidats()
    {
        $candidats = User::where('role', 'candidat')
                        ->orderBy('name')
                        ->get();
        
        return view('adminLayout/gestion_users/listcandidats', compact('candidats'));
    }
    public function formateurs()
    {
        $formateurs = User::where('role', 'formateur')
                         ->orderBy('name')
                         ->get();
        
        return view('adminLayout/gestion_users/listformateurs', compact('formateurs'));
    }
       // Bloquer/Débloquer un utilisateur
       public function toggleBlock(User $user)
       {
           $user->update(['is_active' => !$user->is_active]);
           
           $message = $user->is_active 
           ? 'Utilisateur débloqué avec succès' 
           : 'Utilisateur bloqué avec succès';
       
       return back()->with('success', $message);    }
   
      
}