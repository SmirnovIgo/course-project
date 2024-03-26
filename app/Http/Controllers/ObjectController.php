<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ObjectController extends Controller
{
    public function index()
    {
        return view('objects.index');
    }

    public function store(Request $request)
    {
        $object = new Object();
        $object->name = $request->name;
        $object->save();
        return redirect()->route('object.index');
    }

    public function edit($id)
    {
        $object = Object::find($id);
        return view('objects.edit', compact('object'));
    }

    public function update(Request $request, $id)
    {
        $object = Object::find($id);
        $object->name = $request->name;
        $object->save();
        return redirect()->route('object.index');
    }

    public function destroy($id)
    {
        $object = Object::find($id);
        $object->delete();
        return redirect()->route('object.index');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $objects = Object::where('name', 'like', '%' . $search . '%')->get();
        return view('objects.index', compact('objects'));
    }

    public function show()
    {
        $objects = Object::all();
        return view('objects.show', compact('objects'));
    }

    public function create()
    {
        return view('objects.create');
    }
}
