<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUser;
use App\Http\Requests\UpdateUserRequest;
use Caffeinated\Shinobi\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']); // Valida todos los métodos que el usuario esté en sesión
    }

    /**
     * Índice de usuarios
     * 
     * @return Illuminate\View
     */
    public function index()
    {
        if (!auth()->user()->can('index.users'))
        abort(401);

        $users = User::paginate(10);
        return view('usuarios.index', compact('users'));
    }

    /**
     * Muestra los datos de un usuario dependiendo su ID
     * 
     * @return Illuminate\View
     */
    public function show(User $user)
    {
        if (!auth()->user()->can('index.user'))
        abort(401);

        $reservations = $user->reservations;
        return view('usuarios.show-user', compact('reservations', 'user'));
    }

    /**
     * Te muestra el formulario para crear un nuevo usuario
     */
    public function create()
    {
        if (!auth()->user()->can('create.user'))
        abort(401);

        return view('usuarios.create-user');
    }

    /**
     * Se almacena el usuario en la base de datos
     */
    public function store(CreateUser $request)
    {
        $data = $request->validated();

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        // Se cifra la contraseña con el algoritmo BCrypt
        $user->password = bcrypt($data['password']);
        $user->save();

        return redirect()->route('users')->with('success', 'Usuario creado con éxito');
    }

    /**
     * Mustra la pantalla de editar usuarios
     */
    public function edit(User $user)
    {
        if (!auth()->user()->can('edit.user'))
        abort(401, 'Acceso no permitido');

        $roles = Role::all();

        return view('usuarios.edit-user', compact('user', 'roles'));
    }

    /**
     * Se actualizan los datos de un usuario en la base de datos
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();
        $user->name = $data['name'];
        $user->email = $data['email'];

        $user->password = bcrypt($data['password']); // Se cifra la contraseña con el algoritmo BCrypt
        $user->save();

        return redirect()->back()->with('success', 'Datos actualizados');
    }

    /**
     * Se elimina un usuario
     */
    public function destroy(User $user)
    {
        if (!auth()->user()->can('destroy.user'))
        abort(401);

        $user->delete();
        return redirect()->route('users')->with('success', 'Se eliminó el usuario');
    }

    /**
     * Se asigna un rol a un usuario
     */
    public function assignRoleUser(Request $request, User $user)
    {
        $request->validate([
            'slug' => 'required|string|exists:roles,slug',
        ]);

        if (!auth()->user()->can('assign.role.user'))
        abort(401);

        $data = $request->all();

        $user->assignRoles($data['slug']);
        return redirect()->back()->with('success', 'Role asignado');
    }

    /**
     * Se remueve un role a un usuario
     */
    public function removeRoleUser(Request $request, User $user)
    {
        $request->validate([
            'slug' => 'required|string|exists:roles,slug',
        ]);

        if (!auth()->user()->can('assign.role.user'))
        abort(401);

        $data = $request->all();
        $slug = $data['slug'];

        $user->removeRoles($slug);
        return redirect()->back()->with('success', 'Role removido');
    }
}
