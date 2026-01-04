<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Resource;
use App\Models\Log;
use App\Notifications\ReservationStatusNotification;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewReservationNotification;

class ReservationController extends Controller
{
    /**
     * Liste des réservations pour l'utilisateur connecté (Utilisateur Interne)
     */
    public function index()
    {
        $reservations = Reservation::where('user_id', Auth::id())
            ->with('resource')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('reservations.index', compact('reservations'));
    }

    /**
     * Formulaire de création de réservation
     */
    public function create()
    {
        // On ne propose que les ressources qui ne sont pas en maintenance
        $resources = Resource::where('status', 'disponible')->get();
        return view('reservations.create', compact('resources'));
    }

    /**
     * Enregistrement d'une nouvelle demande (avec vérification de conflit)
     */
    public function store(Request $request)
{
    $request->validate([
        'resource_id' => 'required|exists:resources,id',
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after:start_date',
        'justification' => 'required|string|max:1000',
    ]);

    // VERIFICATION PROFESSIONNELLE DES CONFLITS
    $hasConflict = Reservation::overlapping(
        $request->resource_id, 
        $request->start_date, 
        $request->end_date
    )->exists();

    if ($hasConflict) {
        return back()->withErrors(['conflit' => 'Désolé, cette ressource est déjà réservée ou demandée pour cette période.'])
                     ->withInput();
    }

    // 1. Création de la réservation
    $reservation = Reservation::create([
        'user_id' => Auth::id(),
        'resource_id' => $request->resource_id,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'justification' => $request->justification,
        'status' => 'en_attente',
    ]);

    // 2. ENVOI DE LA NOTIFICATION (Pour que le responsable voie "Notifications (1)")
    // On récupère le responsable de cette ressource (si vous avez un manager_id) 
    // ou tous les utilisateurs ayant le rôle 'responsable'
    $responsables = \App\Models\User::where('role', 'responsable')->get();
    
    foreach ($responsables as $responsable) {
        $responsable->notify(new \App\Notifications\NewReservationNotification($reservation));
    }

    // TRAÇABILITÉ : Journalisation de l'action
    Log::create([
        'user_id' => Auth::id(),
        'action' => 'Création Réservation',
        'description' => "Demande #{$reservation->id} créée pour la ressource ID: {$request->resource_id}"
    ]);

    return redirect()->route('reservations.index')->with('success', 'Votre demande de réservation a été soumise avec succès.');
}

    /**
     * Interface de gestion pour le Responsable Technique
     */
    public function managerIndex()
    {
        // On récupère les réservations liées aux ressources supervisées par le responsable connecté
        $reservations = Reservation::whereHas('resource', function($query) {
            $query->where('manager_id', Auth::id());
        })->with(['resource', 'user'])->orderBy('created_at', 'desc')->get();

        return view('reservations.manager', compact('reservations'));
    }

    /**
     * Mise à jour du statut (Approbation / Refus)
     */
    public function updateStatus(Request $request, Reservation $reservation)
    {
        // Sécurité : Seul le responsable de la ressource ou l'admin peut décider
        if ($reservation->resource->manager_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:Approuvée,Refusée',
            'rejection_reason' => 'required_if:status,Refusée|nullable|string|max:255'
        ]);

        $reservation->update([
            'status' => $request->status,
            'rejection_reason' => $request->rejection_reason
        ]);

        // NOTIFICATION : Envoi automatique (Messagerie interne)
        $reservation->user->notify(new ReservationStatusNotification($reservation));

        // TRAÇABILITÉ
        Log::create([
            'user_id' => Auth::id(),
            'action' => 'Décision Réservation',
            'description' => "La réservation #{$reservation->id} a été {$request->status}."
        ]);

        return back()->with('success', "Le statut de la réservation a été mis à jour.");
    }
    /**
 * Supprimer ou annuler une réservation
 */
public function destroy($id)
{
    // 1. Rechercher la réservation par son ID
    $reservation = \App\Models\Reservation::findOrFail($id);

    // 2. Sécurité : Vérifier que l'utilisateur annule bien SA propre réservation
    if (auth()->id() !== $reservation->user_id) {
        abort(403, 'Action non autorisée.');
    }

    // 3. Supprimer la réservation de la base de données
    $reservation->delete();

    // 4. Rediriger l'utilisateur avec un message de succès
    return back()->with('success', 'Votre réservation a été annulée avec succès.');
}
public function decide($id, $action)
{
    $reservation = \App\Models\Reservation::findOrFail($id);
    
    // Vérification de sécurité pour le rôle responsable
    if (auth()->user()->role !== 'responsable' && auth()->user()->role !== 'admin') {
        abort(403);
    }

    if ($action === 'accepter') {
        $reservation->update(['status' => 'acceptee']);
        $msg = "La réservation a été acceptée avec succès.";
    } else {
        $reservation->update(['status' => 'refusee']);
        $msg = "La réservation a été refusée.";
    }

    return back()->with('success', $msg);
}

}