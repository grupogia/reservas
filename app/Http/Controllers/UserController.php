<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::paginate(10);
        return view('usuarios.index', compact('users'));
    }

    public function create()
    {
        return '';
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(User $user)
    {
        return view('usuarios.edit-user', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy()
    {
        //
    }

    public function assignRoleUser(Request $request, User $user)
    {
        $request->validate([
            'slug' => 'required|string|exists:roles,slug',
        ]);

        $data = $request->all();

        $user->assignRoles($data['slug']);
        return redirect()->back()->with('success', 'Role asignado');
    }

    public function removeRoleUser(Request $request, User $user)
    {
        $request->validate([
            'slug' => 'required|string|exists:roles,slug',
        ]);

        $data = $request->all();

        $slug = $data['slug'];

        $user->removeRoles($slug);
        return redirect()->back()->with('success', 'Role removido');
    }
}
