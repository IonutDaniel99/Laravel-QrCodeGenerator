<?php
// app/Http/Controllers/usersController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Illuminate\Support\Carbon;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user = User::all();
        return view('users.index', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $name = $request->get('name');
        $email = $request->get('email');
        /*         $password = $request->get('password'); */
        $password = password_hash($request->get('password'), PASSWORD_DEFAULT);
        $roles = $request->get('type');

        DB::table('users')->insert([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'roles' => $roles,
            'created_at' => now()
        ]);

        return redirect('/users')->with('success', 'Contact Inserted!');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);


        $name = $request->get('name');
        $email = $request->get('email');
        $password = password_hash($request->get('password'), PASSWORD_DEFAULT);
        $roles = $request->get('type');

        DB::table('users')->where('id', $id)->update([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'roles' => $roles,
            'updated_at' => now()
        ]);

        return redirect('/users')->with('success', 'Contact updated!');
    }


    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/users')->with('success', 'Contact deleted!');
    }
}
