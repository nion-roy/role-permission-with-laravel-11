<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class RoleController extends Controller implements HasMiddleware
{

  public static function middleware(): array
  {
    return [
      new Middleware('permission:view role', only: ['index']),
      new Middleware('permission:create role', only: ['create']),
      new Middleware('permission:update role', only: ['edit']),
      new Middleware('permission:delete role', only: ['destroy']),
    ];
  }
  public function index()
  {
    $roles = Role::latest('id')->get();

    return view('role.index', compact('roles'));
  }

  public function create()
  {
    $permissions = Permission::latest('id')->get();
    return view('role.create', compact('permissions'));
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required',
    ]);

    $role = new Role();
    $role->name = Str::slug($validated['name']);
    $role->save();
    return redirect()->back()->withSuccess('Role create successfull.');
  }

  public function show()
  {
    //
  }

  public function edit(Role $role)
  {
    $role = Role::findOrFail($role->id);
    $permissions = Permission::latest('id')->get();
    $permissionRole = DB::table('role_has_permissions')->where('role_has_permissions.role_id', $role->id)
      ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
      ->all();
    return view('role.edit', compact('role', 'permissions', 'permissionRole'));
  }

  public function update(Role $role, Request $request)
  {
    $validated = $request->validate([
      'name' => 'required|unique:roles,name,' . $role->id,
    ]);

    $role = Role::findOrFail($role->id);
    $role->name = Str::slug($validated['name']);
    $role->save();

    $role->syncPermissions($request->permission);

    return redirect()->back()->with('success', 'Role update successful.');
  }


  public function destroy(Role $role)
  {
    Role::findOrFail($role->id)->delete();
    return redirect()->back()->withSuccess('Role delete successfull.');
  }
}
