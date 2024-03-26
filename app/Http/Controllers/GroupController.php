<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class GroupController extends Controller
{
    public static string $PAGE = 'groups';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->checkPermission(self::$PAGE, 0)) {
            return back()->withErrors(["message" => Lang::get('translation.not_allowed')]);
        }
        $groups = Group::get();
        return view('groups.index', ['groups' => $groups]);
    }

    public function create() {
        if(!Auth::user()->checkPermission(self::$PAGE, 1)) {
            return back()->withErrors(["message" => Lang::get('translation.not_allowed')]);
        }
        return view('groups.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->checkPermission(self::$PAGE, 1)) {
            return back()->withErrors(["message" => Lang::get('translation.not_allowed')]);
        }
        $groups = Group::create($request->all());
        return redirect()->route('groups.index')->with('success', 'Group created successfully.');
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
        $groups = Group::find($id);
        return view('groups.edit', ['groups' => $groups]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(!Auth::user()->checkPermission(self::$PAGE, 2)) {
            return back()->withErrors(["message" => Lang::get('translation.not_allowed')]);
        }
        $groups = Group::find($id);
        $groups->update($request->all());
        return redirect()->route('groups.index')->with('success', 'Group updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!Auth::user()->checkPermission(self::$PAGE, 3)) {
            return back()->withErrors(["message" => Lang::get('translation.not_allowed')]);
        }
        $groups = Group::find($id);
        $groups->delete();
        return redirect()->route('groups.index')->with('success', 'Group deleted successfully.');
    }
}
