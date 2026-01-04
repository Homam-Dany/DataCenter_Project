@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tableau de Bord</h1>
    
    <div class="stats-grid">
        <div class="stat-item">
            <p>Taux d'Occupation</p>
            <div class="stat-value">{{ $occupancyRate }}%</div>
        </div>
        <div class="stat-item" style="background-color: #27ae60;">
            <p>Ressources Totales</p>
            <div class="stat-value">{{ $totalResources }}</div>
        </div>
        <div class="stat-item" style="background-color: #e67e22;">
            <p>En Maintenance</p>
            <div class="stat-value">{{ $maintenanceCount }}</div>
        </div>
    </div>

    <div class="card">
        <h3>Résumé de l'activité</h3>
        <p>Bienvenue dans le système de gestion du Data Center. Utilisez le menu supérieur pour naviguer.</p>
    </div>
</div>
@endsection