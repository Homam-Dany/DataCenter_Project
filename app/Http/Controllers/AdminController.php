<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\User;
use App\Models\Resource;
use App\Models\Reservation;

class AdminController extends Controller
{
    /**
     * Tableau de bord global de l'administrateur
     */
    public function dashboard()
    {
        // Statistiques demandées par l'énoncé
        $stats = [
            'total_users' => User::count(),
            'total_resources' => Resource::count(),
            'active_reservations' => Reservation::where('status', 'active')->count(),
            'pending_accounts' => User::where('role', 'guest')->count(), // Demandes d'ouverture de compte
        ];

        // Taux d'occupation global
        $stats['occupancy_rate'] = $stats['total_resources'] > 0 
            ? round(($stats['active_reservations'] / $stats['total_resources']) * 100) 
            : 0;

        return view('admin.dashboard', compact('stats'));
    }

    /**
     * Gestion des utilisateurs (Liste et Rôles)
     */
    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    /**
     * Changer le rôle ou activer/désactiver un utilisateur
     */
   public function updateUser(Request $request, User $user)
{
    // Validation souple pour accepter soit le rôle, soit l'état actif
    $validated = $request->validate([
        'role' => 'nullable|in:guest,user,responsable,admin',
        'is_active' => 'nullable|boolean',
    ]);

    if ($request->has('role')) {
        $user->role = $request->role;
    }

    if ($request->has('is_active')) {
        $user->is_active = $request->is_active;
    }

    $user->save();

    Log::create([
        'action' => 'Gestion Compte',
        'description' => "Mise à jour de l'utilisateur {$user->name} (Rôle: {$user->role}, Actif: {$user->is_active})",
        'user_id' => auth()->id(),
    ]);

    return redirect()->back()->with('success', 'Utilisateur mis à jour avec succès.');
}

    /**
     * Consultation des journaux (Logs)
     */
    public function logs()
    {
        $logs = Log::with('user')->latest()->paginate(20);
        return view('admin.logs', compact('logs'));
    }
}