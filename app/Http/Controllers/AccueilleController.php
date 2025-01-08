<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Facture;
use App\Models\Facturotheque;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AccueilleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Liste des périodes à analyser
        $periods = [
            'Ajourd\'hui    ' => today(),
            'Hier' => today()->subDay(),
            'Avant_hier' => today()->subDays(2),
            'Cette semaine' => [now()->startOfWeek(), now()->endOfWeek()],
            'Ce_mois' => [now()->startOfMonth(), now()->endOfMonth()],
            'Derniers_trois_mois' => [now()->subMonths(3)->startOfMonth(), now()->endOfMonth()],
            'Cette année' => [now()->startOfYear(), now()->endOfYear()],
            'Année dernière' => [now()->subYear()->startOfYear(), now()->subYear()->endOfYear()],
        ];

        // Préparer les données
        $salesData = [];

        foreach ($periods as $key => $period) {
            if (is_array($period)) {
                // Si la période est un intervalle (ex: cette semaine)
                $total = Facturotheque::whereBetween('created_at', $period)->sum('total');
                $max = Facturotheque::whereBetween('created_at', $period)->max('total');
                $min = Facturotheque::whereBetween('created_at', $period)->min('total');

                // Récupérer le produit le plus vendu pour cette période
                $topProduct = Facture::whereBetween('created_at', $period)
                    ->select('produit_id', DB::raw('SUM(total) as total_sales'))
                    ->groupBy('produit_id')
                    ->orderByDesc('total_sales')
                    ->first();
            } else {
                // Si la période est une date spécifique (ex: aujourd'hui, hier)
                $total = Facturotheque::whereDate('created_at', $period)->sum('total');
                $max = Facturotheque::whereDate('created_at', $period)->max('total');
                $min = Facturotheque::whereDate('created_at', $period)->min('total');

                // Récupérer le produit le plus vendu pour cette période
                $topProduct = Facture::whereDate('created_at', $period)
                    ->select('produit_id', DB::raw('SUM(montant) as total_sales'))
                    ->groupBy('produit_id')
                    ->orderByDesc('total_sales')
                    ->first();
            }

            $salesData[$key] = [
                'total' => $total,
                'max' => $max,
                'min' => $min,
                'topProduct' => $topProduct ? $topProduct->product_id : null, // Assurez-vous d'avoir l'ID du produit
            ];
        }

        // Passer les données à la vue
        return view('statistique.ventes', [
            'salesData' => $salesData,
        ]);
    }




    /**
     * Show the form for creating a new resource.
     */
    public function caisse()
    {
        // Récupérer la date actuelle
        $aujourdhui = Carbon::today();

        // Calculer les totaux globaux et d'aujourd'hui pour les factures et les dépenses
        $totaux = [
            'totalFactures' => Facturotheque::sum('total'),
            'totalFacturesAujourdhui' => Facturotheque::whereDate('created_at', $aujourdhui)->sum('total'),
            'totalDepenses' => Expense::sum('amount'),
            'totalDepensesAujourdhui' => Expense::whereDate('created_at', $aujourdhui)->sum('amount'),
        ];
        
        // Calculer les totaux supplémentaires
        $totaux['totalVenduAuj'] = $totaux['totalFacturesAujourdhui'] - $totaux['totalDepensesAujourdhui'];
        $totaux['soldeCaisse'] = $totaux['totalFactures'] - $totaux['totalDepenses'];

        // Compter le nombre de produits
        $nombreProduit = Produit::count();

        // Retourner les données à la vue
        return view('accueille', array_merge($totaux, compact('nombreProduit')));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
