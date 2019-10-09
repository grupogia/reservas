<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUser;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        if (!auth()->user()->can('index.users'))
        abort(404);

        $users = User::paginate(10);
        return view('usuarios.index', compact('users'));
    }

    public function create()
    {
        if (!auth()->user()->can('create.user'))
        abort(404);

        return view('usuarios.create-user');
    }

    public function store(CreateUser $request)
    {
        $data = $request->validated();

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->save();

        return redirect()->route('users')->with('success', 'Usuario creado con éxito');
    }

    public function edit(User $user)
    {
        if (!auth()->user()->can('edit.user'))
        abort(404);

        return view('usuarios.edit-user', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        if (!auth()->user()->can('destroy.user'))
        abort(404);

        $user->delete();
        return redirect()->route('users')->with('success', 'Se eliminó el usuario');
    }

    public function assignRoleUser(Request $request, User $user)
    {
        $request->validate([
            'slug' => 'required|string|exists:roles,slug',
        ]);

        if (!auth()->user()->can('assign.role.user'))
        abort(404);

        $data = $request->all();

        $user->assignRoles($data['slug']);
        return redirect()->back()->with('success', 'Role asignado');
    }

    public function removeRoleUser(Request $request, User $user)
    {
        $request->validate([
            'slug' => 'required|string|exists:roles,slug',
        ]);

        if (!auth()->user()->can('assign.role.user'))
        abort(404);

        $data = $request->all();
        $slug = $data['slug'];

        $user->removeRoles($slug);
        return redirect()->back()->with('success', 'Role removido');
    }
}
