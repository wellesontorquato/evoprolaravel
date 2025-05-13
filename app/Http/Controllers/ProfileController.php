<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', ['user' => auth()->user()]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'cress' => 'nullable|string|max:255',
            'signature' => 'nullable|string',
        ]);

        $user = auth()->user();
        $user->update($request->only('name', 'email', 'cress', 'signature'));

        return back()->with('success', 'Perfil atualizado com sucesso.');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ], [], [
            'password' => 'senha',
        ]);

        $user = $request->user();

        auth()->logout();

        $user->delete();

        return redirect('/')->with('conta_excluida', 'Sua conta foi excluída com sucesso.');
    }
}
