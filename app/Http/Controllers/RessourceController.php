<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\Log;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResourceController extends Controller
{
    /**
     * Vue publique : Catalogue des ressources (Invité / Utilisateur)
     */
    public function index(Request $request)
    {
        $query = Resource::query();

        // Filtres
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $resources = $query->with('manager')->get();

        // Calcul du taux d'occupation pour la vue catalogue
        $totalResources = Resource::count();
        $occupiedResources = Reservation::where('status', 'Approuvée')
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->distinct('resource_id')
            ->count('resource_id');

        $occupancyRate = $totalResources > 0 ? round(($occupiedResources / $totalResources) * 100, 2) : 0;

        // On passe bien occupancyRate à la vue pour éviter l'erreur "Undefined variable"
        return view('resources.index', compact('resources', 'occupancyRate'));
    }

    /**
     * Vue Responsable : Gestion des ressources supervisées
     */
    public function managerIndex()
    {
        $resources = Resource::where('manager_id', Auth::id())->get();
        return view('resources.manager', compact('resources'));
    }

    /**
     * Formulaire de création (Méthode manquante qui causait l'erreur)
     */
    public function create()
    {
        return view('resources.create');
    }

    /**
     * Enregistrement d'une ressource
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'category' => 'required|string',
            'cpu' => 'nullable|integer',
            'ram' => 'nullable|integer',
            'storage_capacity' => 'nullable|integer',
            'storage_type' => 'nullable|string',
            'bandwidth' => 'nullable|string',
            'os' => 'nullable|string',
            'location' => 'nullable|string',
        ]);

        $validated['manager_id'] = Auth::id();
        $validated['status'] = 'disponible';

        $resource = Resource::create($validated);

        Log::create([
            'user_id' => Auth::id(),
            'action' => 'Ajout Ressource',
            'description' => "Nouvelle ressource ajoutée : {$resource->name}"
        ]);

        return redirect()->route('resources.manager')->with('success', 'La ressource a été ajoutée.');
    }

    /**
     * Formulaire de modification (Méthode manquante qui causait l'erreur)
     */
    public function edit(Resource $resource)
    {
        // Vérification des droits
        if ($resource->manager_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        return view('resources.edit', compact('resource'));
    }

    /**
     * Mise à jour des caractéristiques
     */
    public function update(Request $request, Resource $resource)
    {
        if ($resource->manager_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $resource->update($request->all());

        Log::create([
            'user_id' => Auth::id(),
            'action' => 'Modification Ressource',
            'description' => "Caractéristiques mises à jour : {$resource->name}"
        ]);

        return redirect()->route('resources.manager')->with('success', 'Caractéristiques mises à jour.');
    }

    /**
     * Maintenance
     */
    public function toggleMaintenance(Resource $resource)
    {
        if ($resource->manager_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $newStatus = ($resource->status === 'maintenance') ? 'disponible' : 'maintenance';
        $resource->update(['status' => $newStatus]);

        Log::create([
            'user_id' => Auth::id(),
            'action' => 'Changement Statut',
            'description' => "La ressource {$resource->name} est en : {$newStatus}"
        ]);

        return redirect()->back()->with('success', "Statut changé en {$newStatus}.");
    }
}