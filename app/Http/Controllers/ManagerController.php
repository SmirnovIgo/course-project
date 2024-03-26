<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function index()
    {
        return view('manager.index');
    }

    public function store(Request $request)
    {
        $manager = new Manager();
        $manager->name = $request->name;
        $manager->save();
        return redirect()->route('manager.index');
    }

    public function edit($id)
    {
        $manager = Manager::find($id);
        return view('manager.edit', compact('manager'));
    }

    public function update(Request $request, $id)
    {
        $manager = Manager::find($id);
        $manager->name = $request->name;
        $manager->save();
        return redirect()->route('manager.index');
    }

    public function destroy($id)
    {
        $manager = Manager::find($id);
        $manager->delete();
        return redirect()->route('manager.index');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $managers = Manager::where('name', 'like', '%' . $search . '%')->get();
        return view('manager.index', compact('managers'));
    }

    public function show()
    {
        $managers = Manager::all();
        return view('manager.show', compact('managers'));
    }

    public function create()
    {
        return view('manager.create');
    }
}
