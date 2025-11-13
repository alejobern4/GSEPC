<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Persona;
use App\Http\Controllers\Controller;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function handle(Request $request)
    {
        if ($request->action === 'login') {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('/dashboard'); // o '/home'
            }

            return back()->withErrors([
                'email' => 'Las credenciales no coinciden.',
            ])->withInput();

        } elseif ($request->action === 'register') {
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'primer_nombre' => ['required', 'string', 'max:255'],
                'segundo_nombre' => ['nullable', 'string', 'max:255'],
                'primer_apellido' => ['required', 'string', 'max:255'],
                'segundo_apellido' => ['nullable', 'string', 'max:255'],
                'num_documento' => ['required', 'string', 'max:255', 'unique:personas'],
                'id_tipdocumento' => ['required', 'integer'],
            ]);

            $persona = Persona::create([
                'primer_nombre' => $request->primer_nombre,
                'segundo_nombre' => $request->segundo_nombre,
                'primer_apellido' => $request->primer_apellido,
                'segundo_apellido' => $request->segundo_apellido,
                'num_documento' => $request->num_documento,
                'id_tipdocumento' => $request->id_tipdocumento,
            ]);

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'id_persona' => $persona->id,
            ]);

            Auth::login($user);
            return redirect('/dashboard');
        }

        return back()->withErrors(['action' => 'Acción no válida.']);
    }
}
