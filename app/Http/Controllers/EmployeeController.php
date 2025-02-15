<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        
        $employees = Employee::all();
        return view('employees.create', compact('employees'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees',
            'position' => 'required',
            'salary' => 'required|numeric'
        ]);

        Employee::create($request->all());
        
        notify()->success('Employé ajouté avec succès.');
        return redirect()->route('employees.index');
    }

    public function show(Employee $employee)
    {
        dd("ok");
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'position' => 'required',
            'salary' => 'required|numeric'
        ]);

        $employee->update($request->all());
        return redirect()->route('employees.index')->with('success', 'Employé mis à jour.');
    }

    public function destroy(Employee $employee)
    {
    
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employé supprimé.');
    }
}
