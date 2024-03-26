<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return view('roles.index');
    }

    public function store(Request $request)
    {
        $role = new Role();
        $role->name = $request->name;
        $role->save();
        return redirect()->route('role.index');
    }

    public function edit($id)
    {
        $role = Role::find($id);
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();
        return redirect()->route('role.index');
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        return redirect()->route('role.index');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $roles = Role::where('name', 'like', '%' . $search . '%')->get();
        return view('roles.index', compact('roles'));
    }

    public function show()
    {
        $roles = Role::all();
        return view('roles.show', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }
}
