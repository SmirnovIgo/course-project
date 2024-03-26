<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    public function index()
    {
        return view('administrator.index');
    }
    
    public function store(Request $request)
    {
        $administrator = new Administrator();
        $administrator->name = $request->name;
        $administrator->save();
        return redirect()->route('administrator.index');
    }

    public function edit($id)
    {
        $administrator = Administrator::find($id);
        return view('administrator.edit', compact('administrator'));
    }

    public function update(Request $request, $id)
    {
        $administrator = Administrator::find($id);
        $administrator->name = $request->name;
        $administrator->save();
        return redirect()->route('administrator.index');
    }

    public function destroy($id)
    {
        $administrator = Administrator::find($id);
        $administrator->delete();
        return redirect()->route('administrator.index');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $administrators = Administrator::where('name', 'like', '%' . $search . '%')->get();
        return view('administrator.index', compact('administrators'));
    }

    public function show() 
    {
        $administrators = Administrator::all();
        return view('administrator.show', compact('administrators'));
    }

    public function create()
    {
        return view('administrator.create');
    }
}
