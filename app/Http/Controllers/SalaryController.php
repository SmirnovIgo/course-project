<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function index()
    {
        return view('salaries.index');
    }

    public function store(Request $request)
    {
        $salary = new Salary();
        $salary->name = $request->name;
        $salary->save();
        return redirect()->route('salary.index');
    }

    public function edit($id)
    {
        $salary = Salary::find($id);
        return view('salaries.edit', compact('salary'));
    }

    public function update(Request $request, $id)
    {
        $salary = Salary::find($id);
        $salary->name = $request->name;
        $salary->save();
        return redirect()->route('salary.index');
    }

    public function destroy($id)
    {
        $salary = Salary::find($id);
        $salary->delete();
        return redirect()->route('salary.index');
    }
}
