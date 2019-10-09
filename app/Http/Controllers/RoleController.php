<?php

namespace App\Http\Controllers;

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
        $roles = Role::all();

        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create-role');
    }

    public function store()
    {
        return 'store';
    }

    public function edit(Role $role)
    {
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
