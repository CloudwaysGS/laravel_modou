<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $expenses = Expense::orderBy('created_at', 'desc')->paginate(10);
        return view('statistique.depenses', compact('expenses'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('depenses.ajout');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {

        $validatedData = $request->validate([
            'category' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'nullable|date',
            ]);
        $validatedData['date'] = now();



        // Créer la dépense
        Expense::create($validatedData);

        // Rediriger avec un message de succès
        return redirect()->route('statistique.depenses')->with('success', 'Dépense ajoutée avec succès!');
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
        $expense = Expense::findOrFail($id);

        return view('depenses.modifier', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        $expense = Expense::findOrFail($id);
        $expense->update($validated);

        // Rediriger avec un message de succès
        return redirect()->route('expenses.index')->with('success', 'Dépense mise à jour avec succès.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $expense = Expense::findOrFail($id);

        // Supprimer la dépense
        $expense->delete();

        // Rediriger avec un message de succès
        return redirect()->route('expenses.index')->with('success', 'Dépense supprimée avec succès.');
    }
}
