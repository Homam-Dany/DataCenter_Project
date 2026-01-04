@extends('layouts.app')

@section('content')
<div class="card" style="margin-bottom: 2rem;">
    <h1>Catalogue des Ressources</h1>
    <p>Consultez la disponibilité en temps réel du Data Center.</p>
</div>

<div class="stats-grid">
    <div class="stat-item">
        <p>Taux d'occupation</p>
        <div style="background: rgba(255,255,255,0.2); height: 10px; border-radius: 5px; margin: 10px 0;">
            <div style="width: {{ $occupancyRate ?? 0 }}%; background: white; height: 100%; border-radius: 5px;"></div>
        </div>
        <div class="stat-value">{{ $occupancyRate ?? 0 }}%</div>
    </div>
    
    <div class="stat-item" style="background-color: #e67e22;">
        <p>En Maintenance</p>
        <div class="stat-value">{{ $resources->where('status', 'maintenance')->count() }}</div>
    </div>
</div>

<div class="stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));">
    @foreach($resources as $resource)
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
            <h3 style="color: #2c3e50;">{{ $resource->name }}</h3>
            <span class="badge {{ $resource->status === 'disponible' ? 'badge-approved' : 'badge-rejected' }}">
                {{ $resource->status }}
            </span>
        </div>

        <p style="font-size: 0.85rem; color: #7f8c8d; margin-bottom: 15px;">
            {{ $resource->type }} | {{ $resource->category }}
        </p>

        <table style="font-size: 0.9rem; margin-bottom: 20px;">
            <tr>
                <td><strong>CPU</strong></td>
                <td>{{ $resource->cpu }} Cores</td>
            </tr>
            <tr>
                <td><strong>RAM</strong></td>
                <td>{{ $resource->ram }} Go</td>
            </tr>
            <tr>
                <td><strong>OS</strong></td>
                <td>{{ $resource->os }}</td>
            </tr>
            <tr>
                <td><strong>Localisation</strong></td>
                <td>{{ $resource->location }}</td>
            </tr>
        </table>

        <div style="text-align: center; border-top: 1px solid #eee; pt-15; margin-top: 10px; padding-top: 15px;">
            @auth
                @if($resource->status === 'disponible')
                    <a href="{{ route('reservations.create', ['resource' => $resource->id]) }}" class="btn btn-primary" style="width: 100%;">Réserver cette ressource</a>
                @else
                    <button class="btn" style="width: 100%; background: #bdc3c7; cursor: not-allowed;" disabled>Indisponible</button>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-primary" style="width: 100%;">Se connecter pour réserver</a>
            @endauth
        </div>
    </div>
    @endforeach
</div>
@endsection