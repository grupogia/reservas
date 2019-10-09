<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRole;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (!auth()->user()->can('index.role'))
        abort(404);

        $roles = Role::all();

        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create-role');
    }

    public function store(CreateRole $request)
    {
        $data = $request->validated();

        $role = new Role();
        $role->slug = $data['slug'];
        $role->name = $data['name'];
        $role->description = $data['description'];
        $role->save();

        return redirect()->route('roles')->with('success', 'Role creado correctamente');
    }

    public function edit(Role $role)
    {
        if (!auth()->user()->can('edit.role'))
        abort(401);

        return view('roles.edit-role', compact('role'));
    }

    public function update()
    {
        return 'update';
    }

    public function delete()
    {
        return 'delete';
    }

    public function assignPermission(Request $request, Role $role)
    {
        $request->validate([
            'slug' => 'required|exists:permissions,slug',
        ]);

        $data = $request->all();
        $slug = $data['slug'];

        $role->givePermissionTo($slug);
        return redirect()->back();
    }
}
