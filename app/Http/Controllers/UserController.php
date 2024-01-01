<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        // dd($roles);
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // create user sekaligus role
        // dd($request->role);
        $id = User::create($request->all())->assignRole($request->role)->id;

        // create teacher
        $name = $request->name;
        Teacher::create([
            'user_id' => $id,
            'name' => $name
        ]);
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // dd($request->role);
        // dd($user->roles()->first()->name);
        $user->update($request->all());


        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index');
    }

    // untuk edit role
    public function editrole(Request $request)
    {
        $user_id = $request->urole;
        $user = User::where('id', $user_id)->first();

        return view('admin.user.editrole', compact('user'));
    }

    // update role
    public function updaterole(Request $request)
    {
        $user_id = $request->urole;
        $role = $request->role;

        // untuk menimpa role
        $user = User::where('id', $user_id)->first();
        $user->syncRoles($role);

        return redirect()->route('user.index');
    }
}
