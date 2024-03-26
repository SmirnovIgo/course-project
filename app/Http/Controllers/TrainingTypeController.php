<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainingTypeController extends Controller
{
    public function index()
    {
        return view('training_types.index');
    }

    public function store(Request $request)
    {
        $training_type = new TrainingType();
        $training_type->name = $request->name;
        $training_type->save();
        return redirect()->route('training_type.index');
    }

    public function edit($id)
    {
        $training_type = TrainingType::find($id);
        return view('training_types.edit', compact('training_type'));
    }

    public function update(Request $request, $id)
    {
        $training_type = TrainingType::find($id);
        $training_type->name = $request->name;
        $training_type->save();
        return redirect()->route('training_type.index');
    }

    public function destroy($id)

    {
        $training_type = TrainingType::find($id);
        $training_type->delete();
        return redirect()->route('training_type.index');
    }
}
