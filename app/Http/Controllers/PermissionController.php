<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class PermissionController extends Controller implements HasMiddleware
{

  public static function middleware(): array
  {
    return [
      new Middleware('permission:view permission', only: ['index']),
      new Middleware('permission:create permission', only: ['create']),
      new Middleware('permission:update permission', only: ['edit']),
      new Middleware('permission:delete permission', only: ['destroy']),
    ];
  }

  public function index()
  {
    $permissions = Permission::latest('id')->get();
    return view('permission.index', compact('permissions'));
  }

  public function create()
  {
    return view('permission.create');
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required',
    ]);

    $permission = new Permission();
    $permission->name = Str::slug($validated['name']);
    $permission->save();
    return redirect()->back()->withSuccess('Permission create successfull.');
  }

  public function show()
  {
    //
  }

  public function edit(Permission $permission)
  {
    $permission = Permission::findOrFail($permission->id);
    return view('permission.edit', compact('permission'));
  }

  public function update(Permission $permission, Request $request)
  {
    $validated = $request->validate([
      'name' => 'required',
    ]);

    $permission = Permission::findOrFail($permission->id);
    $permission->name = Str::slug($validated['name']);
    $permission->save();
    return redirect()->back()->withSuccess('Permission update successfull.');
  }

  public function destroy(Permission $permission)
  {
    Permission::findOrFail($permission->id)->delete();
    return redirect()->back()->withSuccess('Permission delete successfull.');
  }
}
