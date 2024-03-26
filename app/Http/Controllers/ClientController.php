<?php

// app/Http/Controllers/ClientController.php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }
}



class ClientController extends Controller

{
    public static string $PAGE = 'clients';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if(!Auth::user()->checkPermission(self::$PAGE, 0)) {
            return back()->withErrors(["message" => Lang::get('translation.not_allowed')]);
        }
        $clients = Client::get();
        return view('clients.index', ['clients' => $clients]);
    }

    public function create() {
        if(!Auth::user()->checkPermission(self::$PAGE, 1)) {
            return back()->withErrors(["message" => Lang::get('translation.not_allowed')]);
        }
       return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->checkPermission(self::$PAGE, 1)) {
            return back()->withErrors(["message" => Lang::get('translation.not_allowed')]);
        }
        $clients = Client::create($request->all());
        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
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
        $client = Client::find($id);
        return view('clients.edit', ['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(!Auth::user()->checkPermission(self::$PAGE, 2)) {
            return back()->withErrors(["message" => Lang::get('translation.not_allowed')]);
        }
        $client = Client::find($id);
        $client->update($request->all());
        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!Auth::user()->checkPermission(self::$PAGE, 3)) {
            return back()->withErrors(["message" => Lang::get('translation.not_allowed')]);
        }
        $client = Client::find($id);
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }

    public function lide()
    {
        $clients = Client::all();
        return view('clients.lide', ['clients' => $clients]);
    }
}
