<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\EditProfile;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('auth.profile');
    }

    public function update(EditProfile $request)
    {
        $data = $request->validated();

        $user = auth()->user();

        $user->name = $data['name'];
        $user->email = $data['email'];

        if (!empty($data['password']))
        $user->password = bcrypt($data['password']);

        $user->save();
        return redirect()->route('profile')->with('success', 'Datos actualizados correctamente');
    }
}
