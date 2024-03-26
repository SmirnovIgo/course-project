<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimeController extends Controller
{
    public function index()
    {
        return view('time.index');
    }

    public function store(Request $request)
    {
        $time = new Time();
        $time->name = $request->name;
        $time->save();
        return redirect()->route('time.index');
    }

    public function edit($id)
    {
        $time = Time::find($id);
        return view('time.edit', compact('time'));
    }

    public function update(Request $request, $id)
    {
        $time = Time::find($id);
        $time->name = $request->name;
        $time->save();
        return redirect()->route('time.index');
    }

    public function destroy($id)
    {
        $time = Time::find($id);
        $time->delete();
        return redirect()->route('time.index');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $times = Time::where('name', 'like', '%' . $search . '%')->get();
        return view('time.index', compact('times'));
    }

    public function show()
    {
        $times = Time::all();
        return view('time.show', compact('times'));
    }

    public function create()
    {
        return view('time.create');
    }
}
