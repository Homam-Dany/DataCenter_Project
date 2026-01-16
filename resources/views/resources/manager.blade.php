@extends('layouts.app')

@section('content')
<div class="main-content">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h1 style="color: var(--accent-blue); font-size: 2.5rem;">Mon Parc <span style="color: white;">Informatique</span></h1>
            <p style="color: var(--text-muted);">Gérez la disponibilité technique de vos ressources en temps réel.</p>
        </div>
        {{-- Bouton d'ajout stylisé --}}
        <a href="{{ route('resources.create') }}" class="btn btn-primary">
            + Ajouter une ressource
        </a>
    </div>

    <div class="stats-grid">
        @foreach($resources as $resource)
            <div class="card">
                <div style="margin-bottom: 15px;">
                    <span class="badge {{ $resource->status === 'disponible' ? 'badge-approved' : 'badge-pending' }}" 
                          style="background-color: {{ $resource->status === 'disponible' ? 'var(--accent-green)' : 'var(--accent-orange)' }}; color: #000; padding: 5px 10px; border-radius: 6px; font-weight: bold; font-size: 0.7rem;">
                        {{ strtoupper($resource->status) }}
                    </span>
                </div>

                <div class="resource-header">
                    <h3 style="color: white; margin-bottom: 5px;">{{ $resource->name }}</h3>
                    <p style="color: var(--accent-blue); font-size: 0.9rem; margin-bottom: 15px;">{{ $resource->type }}</p>
                </div>
                
                <div class="resource-body">
                    <ul style="list-style: none; padding: 0; margin-bottom: 20px;">
                        <li style="margin-bottom: 8px; color: var(--text-muted);">
                            ⚡ CPU : <strong style="color: white;">{{ $resource->cpu }} Coeurs</strong>
                        </li>
                        <li style="margin-bottom: 8px; color: var(--text-muted);">
                            💾 RAM : <strong style="color: white;">{{ $resource->ram }} Go</strong>
                        </li>
                    </ul>
                </div>

                <div class="resource-footer" style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 15px;">
                    <form action="{{ route('resources.toggleMaintenance', $resource->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn {{ $resource->status === 'maintenance' ? 'btn-success' : 'btn-warning' }}" style="font-size: 0.8rem; padding: 8px 12px;">
                            {{ $resource->status === 'maintenance' ? 'Remettre en service' : 'Mettre en maintenance' }}
                        </button>
                    </form>

                    {{-- BOUTON MODIFIER STYLISÉ --}}
                    <a href="{{ route('resources.edit', $resource->id) }}" 
                       style="
                        display: inline-block;
                        padding: 8px 16px;
                        background: rgba(99, 102, 241, 0.1);
                        border: 1px solid #6366f1;
                        border-radius: 6px;
                        color: #6366f1;
                        font-size: 0.85rem;
                        font-weight: 600;
                        text-decoration: none;
                        text-transform: uppercase;
                        transition: all 0.3s ease;
                        box-shadow: 0 0 10px rgba(99, 102, 241, 0.2);"
                       onmouseover="this.style.background='#6366f1'; this.style.color='white'; this.style.boxShadow='0 0 15px rgba(99, 102, 241, 0.5)';"
                       onmouseout="this.style.background='rgba(99, 102, 241, 0.1)'; this.style.color='#6366f1'; this.style.boxShadow='0 0 10px rgba(99, 102, 241, 0.2)';"
                    >
                        Modifier
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection