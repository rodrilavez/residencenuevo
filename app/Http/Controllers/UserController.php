<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if(Auth::user()->role !== 'admin') abort(403);

        $users = User::all();
        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        if(Auth::user()->role !== 'admin') abort(403);
        return view('dashboard.users.create');
    }

    public function store(Request $request)
    {
        if(Auth::user()->role !== 'admin') abort(403);

        $data = $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6',
            'role'=>'required|in:admin,guard,residente'
        ]);

        $data['password'] = Hash::make($data['password']);
        User::create($data);

        return redirect()->route('users.index')->with('message','Usuario creado con éxito');
    }

    public function show(User $user)
    {
        if(Auth::user()->role !== 'admin' && Auth::id() !== $user->id) abort(403);
        return view('dashboard.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        if(Auth::user()->role !== 'admin' && Auth::id() !== $user->id) abort(403);
        return view('dashboard.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if(Auth::user()->role !== 'admin' && Auth::id() !== $user->id) abort(403);

        $data = $request->validate([
            'name'=>'sometimes',
            'email'=>'sometimes|email|unique:users,email,'.$user->id,
            'password'=>'sometimes|min:6',
            'role'=>'sometimes|in:admin,guard,residente'
        ]);

        if(isset($data['password'])) {
            $data['password']=Hash::make($data['password']);
        }

        $user->update($data);
        return redirect()->route('users.index')->with('message','Usuario actualizado');
    }

    public function destroy(User $user)
    {
        if(Auth::user()->role !== 'admin') abort(403);
        $user->delete();
        return redirect()->route('users.index')->with('message','Usuario eliminado');
    }
}
