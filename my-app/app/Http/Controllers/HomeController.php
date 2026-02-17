<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Proteger este controlador para usuarios autenticados
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        return view('dashboard', compact('user'));
    }

    /**
     * Show the profile edit form.
     */
    public function editProfile()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the authenticated user's profile.
     */
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $emailChanged = $data['email'] !== $user->email;

        $user->name = $data['name'];
        $user->email = $data['email'];
        if ($emailChanged) {
            $user->email_verified_at = null;
        }
        $user->save();

        if ($emailChanged) {
            $user->notify(new \Illuminate\Auth\Notifications\VerifyEmail());
        }

        return redirect()->route('home')->with('success', 'Perfil actualizado correctamente.');
    }
}
