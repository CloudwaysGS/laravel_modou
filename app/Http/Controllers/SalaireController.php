<?php

namespace App\Http\Controllers;

use App\Models\Salaire;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaireController extends Controller
{
    public function index()
    {
        $salaries = Salaire::with('employee')->get();
        return view('salaries.index', compact('salaries'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('salaries.avance', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'amount' => 'required|numeric',
        ]);

        $salarie = Employee::select('id', 'name', 'email', 'position')->find($validated['employee_id']);

        Salaire::create([
            'employee_id' => $salarie->id,
            'nom' => $salarie->name,
            'amount' => $validated['amount'],
            'status' => 'En cours',
        ]);

        $salarie->update([
            'avance' => Salaire::where('employee_id', $salarie->id)
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->sum('amount')
        ]);


        notify()->success('Avance ajoutée avec succès!');
        return redirect()->route('salaries.index');
    }


    public function update(Request $request, Salaire $salary)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $salary->update($request->all());
        return redirect()->route('salaries.index')->with('success', 'Statut mis à jour.');
    }
}
