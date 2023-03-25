<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Tables\Users;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index', [
            'users' => Users::class
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = [
            'admin' => 'Admin',
            'operator' => 'Operator',
        ];
        return view('user.create', [
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'roles' => $request->roles,
            'email' => $request->email,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'password' => Hash::make($request->password)
        ]);

        Toast::title('Success add Users!')->success()->backdrop();

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = [
            'admin' => 'Admin',
            'operator' => 'Operator',
        ];
        return view('user.edit', [
            'users' => $user,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required',
            'roles' => 'required',
            'email' => 'required',
        ]);

        $user->update($data);

        Toast::title('Success update Users!')->success()->backdrop();

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        Toast::title('Success delete Users!')->success()->backdrop();
        return redirect()->route('users.index');
    }
}
