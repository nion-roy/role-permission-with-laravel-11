<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class UserController extends Controller implements HasMiddleware
{
  public static function middleware(): array
  {
    return [
      new Middleware('permission:view user', only: ['index']),
      new Middleware('permission:create user', only: ['create']),
      new Middleware('permission:update user', only: ['edit']),
      new Middleware('permission:delete user', only: ['destroy']),
    ];
  }

  public function index()
  {
    $users = User::all();
    return view('user.index', compact('users'));
  }

  public function create()
  {
    $roles = Role::select('id', 'name')->get();
    return view('user.create', compact('roles'));
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required',
      'role' => 'required',
      'password' => 'required',
      'email' => 'required|unique:users',
    ]);

    $user = new User();
    $user->name = $validated['name'];
    $user->email = $validated['email'];
    $user->role = $validated['role'];
    $user->password = Hash::make($validated['password']);
    $user->save();
    return redirect()->back()->withSuccess('User account create successfull.');
  }

  public function show()
  {
    //
  }

  public function edit(User $user)
  {
    $user = User::findOrFail($user->id);
    $roles = Role::get();
    return view('user.edit', compact('user', 'roles'));
  }

  public function update(User $user, Request $request)
  {
    $validated = $request->validate([
      'name' => 'required',
      'role' => 'required',
      'password' => 'required',
      'email' => 'required',
    ]);

    // dd($validated);

    $user = User::findOrFail($user->id);
    $user->name = $validated['name'];
    $user->email = $validated['email'];
    $user->role = $validated['role'];
    $user->password = Hash::make($validated['password']);
    $user->save();
    return redirect()->back()->withSuccess('User account update successfull.');
  }

  public function destroy(User $user)
  {
    User::findOrFail($user->id)->delete();
    return redirect()->back()->withSuccess('User account delete successfull.');
  }
}
