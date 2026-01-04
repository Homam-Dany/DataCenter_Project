<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Affiche le tableau de bord avec les statistiques demandées
     */
    public function index()
    {
        $user = Auth::user();

        // 1. STATISTIQUES GLOBALES (Pour Admin et Responsable)
        // Calcul du taux d'occupation global : (Ressources occupées / Total ressources) * 100
        $totalResources = Resource::count();
        $occupiedResources = Reservation::where('status', 'Approuvée')
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->distinct('resource_id')
            ->count('resource_id');

        $occupancyRate = $totalResources > 0 ? round(($occupiedResources / $totalResources) * 100, 2) : 0;

        // 2. DONNÉES SPÉCIFIQUES PAR RÔLE
        $data = [
            'occupancyRate' => $occupancyRate,
            'totalResources' => $totalResources,
            'maintenanceCount' => Resource::where('status', 'maintenance')->count(),
        ];

        if ($user->isAdmin()) {
            $data['totalUsers'] = User::count();
            $data['pendingAccounts'] = User::where('is_active', false)->count();
            $data['totalReservations'] = Reservation::count();
        } 
        
        elseif ($user->isResponsable()) {
            // Statistiques pour les ressources que ce responsable gère
            $managedIds = Resource::where('manager_id', $user->id)->pluck('id');
            $data['myResourcesCount'] = $managedIds->count();
            $data['pendingRequests'] = Reservation::whereIn('resource_id', $managedIds)
                ->where('status', 'en_attente')
                ->count();
        } 
        
        else {
            // Statistiques pour l'utilisateur interne
            $data['myActiveReservations'] = Reservation::where('user_id', $user->id)
                ->where('status', 'Approuvée')
                ->count();
            $data['myPendingRequests'] = Reservation::where('user_id', $user->id)
                ->where('status', 'en_attente')
                ->count();
        }

        return view('dashboard.index', $data);
    }
}