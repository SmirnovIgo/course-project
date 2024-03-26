<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hall;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;



class HallController extends Controller
{
    public function index()
    {
        $halls = Hall::all();
        return view('halls.index', compact('halls'));
    }

    public function store(Request $request)
    {
        $hall = new Hall();
        $hall->name = $request->name;
        $hall->save();
        return redirect()->route('hall.index');
    }

    public function edit($id)
    {
        $hall = Hall::find($id);
        return view('halls.edit', compact('hall'));
    }

    public function update(Request $request, $id)
    {
        $hall = Hall::find($id);
        $hall->name = $request->name;
        $hall->save();
        return redirect()->route('hall.index');
    }

    public function destroy($id)
    {
        $hall = Hall::find($id);
        $hall->delete();
        return redirect()->route('hall.index');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $halls = Hall::where('name', 'like', '%' . $search . '%')->get();
        return view('halls.index', compact('halls'));
    }

    public function show()
    {
        $halls = Hall::all();
        return view('halls.show', compact('halls'));
    }

    public function create()
    {
        return view('halls.create');
    }
}



class HallController extends Controller
{
    public static string $PAGE = 'halls';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->checkPermission(self::$PAGE, 0)) {
            return back()->withErrors(["message" => Lang::get('translation.not_allowed')]);
        }
        $halls = Hall::get();
        return view('halls.index', ['halls' => $halls]);
    }

    public function create() {
        if(!Auth::user()->checkPermission(self::$PAGE, 1)) {
            return back()->withErrors(["message" => Lang::get('translation.not_allowed')]);
        }
        return view('halls.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->checkPermission(self::$PAGE, 1)) {
            return back()->withErrors(["message" => Lang::get('translation.not_allowed')]);
        }
        $halls = Hall::create($request->all());
        return redirect()->route('halls.index')->with('success', 'Hall created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(!Auth::user()->checkPermission(self::$PAGE, 2)) {
            return back()->withErrors(["message" => Lang::get('translation.not_allowed')]);
        }
        $halls = Hall::find($id);
        return view('halls.edit', ['halls' => $halls]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(!Auth::user()->checkPermission(self::$PAGE, 2)) {
            return back()->withErrors(["message" => Lang::get('translation.not_allowed')]);
        }
        $halls = Hall::find($id);
        $halls->update($request->all());
        return redirect()->route('halls.index')->with('success', 'Hall updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!Auth::user()->checkPermission(self::$PAGE, 3)) {
            return back()->withErrors(["message" => Lang::get('translation.not_allowed')]);
        }
        $halls = Hall::find($id);
        $halls->delete();
        return redirect()->route('halls.index')->with('success', 'Hall deleted successfully.');
    }
}
