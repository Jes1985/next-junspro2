<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use Illuminate\Http\Request;

class MissionAdminController extends Controller
{
    /**
     * Affiche la liste des missions
     */
    public function index(Request $request)
    {
        $query = Mission::query();

        // Filtres
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('offre')) {
            $query->where('offre', $request->offre);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('client_nom', 'like', "%{$search}%")
                  ->orWhere('client_email', 'like', "%{$search}%")
                  ->orWhere('id_mission', 'like', "%{$search}%");
            });
        }

        $missions = $query->orderBy('date_soumission', 'desc')->paginate(20);

        return view('backend.missions.index', compact('missions'));
    }

    /**
     * Affiche les détails d'une mission
     */
    public function show($id)
    {
        $mission = Mission::findOrFail($id);
        return view('backend.missions.show', compact('mission'));
    }

    /**
     * Met à jour le statut d'une mission
     */
    public function updateStatus(Request $request, $id)
    {
        $mission = Mission::findOrFail($id);
        
        $validated = $request->validate([
            'statut' => 'required|in:En_attente,Paiement_valide,RDV_planifie,Termine',
        ]);

        $mission->update($validated);

        return redirect()->back()->with('success', 'Statut mis à jour avec succès');
    }
}


