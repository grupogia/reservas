<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePermission;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (!auth()->user()->can('index.permissions'))
        abort(404);

        $permissions = Permission::all();
        return view('permisos.index', compact('permissions'));
    }

    public function create()
    {
        return view('permisos.create-permission');
    }

    public function store(CreatePermission $request)
    {
        $data = $request->validated();

        $permission = new Permission();
        $permission->slug = $data['slug'];
        $permission->name = $data['name'];
        $permission->description = $data['description'];
        $permission->save();

        return redirect()->route('permissions')->with('success', 'Permiso registrado correctamente');
    }

    public function destroy(Permission $permission)
    {
        if (!auth()->user()->can('delete.permission'))
        abort(404);

        $permission->delete();
        return redirect()->route('permissions')->with('success', 'Permiso eliminado correctamente');
    }
}
