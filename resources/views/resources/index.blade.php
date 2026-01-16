@extends('layouts.app')

@section('content')
{{-- En-tête simplifié : Le bouton d'ajout a été supprimé ici --}}
<div class="card" style="margin-bottom: 2rem;">
    <div style="display: flex; flex-direction: column; align-items: flex-start;">
        <h1 class="title-gradient">Catalogue des Ressources</h1>
        <p style="color: var(--text-muted);">Consultez la disponibilité en temps réel du Data Center.</p>
    </div>
</div>

<div class="stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));">
    @foreach($resources as $resource)
    <div class="card" style="display: flex; flex-direction: column; justify-content: space-between;">
        <div>
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                <h3 style="color: white;">{{ $resource->name }}</h3>
                <span class="badge {{ $resource->status === 'disponible' ? 'badge-approved' : 'badge-rejected' }}">
                    {{ $resource->status }}
                </span>
            </div>

            <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 15px;">
                {{ $resource->type }} | {{ $resource->category }}
            </p>

            <table style="font-size: 0.9rem; margin-bottom: 20px; color: white; width: 100%;">
                <tr><td><strong>CPU</strong></td><td>{{ $resource->cpu }} Cores</td></tr>
                <tr><td><strong>RAM</strong></td><td>{{ $resource->ram }} Go</td></tr>
            </table>
        </div>

        <div>
            {{-- Section Réservation --}}
            <div style="text-align: center; border-top: 1px solid var(--glass-border); padding-top: 15px; margin-bottom: 15px;">
                @auth
                    @if(auth()->user()->role === 'user')
                        @if($resource->status === 'disponible')
                            <a href="{{ route('reservations.create', ['resource' => $resource->id]) }}" class="btn-primary" style="display: block; text-decoration: none;">Réserver</a>
                        @else
                            <button class="btn" style="width: 100%; background: #334155; color: #94a3b8; cursor: not-allowed;" disabled>Indisponible</button>
                        @endif
                    @else
                        {{-- Message pour Admin/Responsable : Indique qu'ils sont en mode vue --}}
                        <p style="color: var(--text-muted); font-size: 0.8rem; font-style: italic;">Mode consultation (Gestion via "Ma Gestion")</p>
                    @endif
                @else
                    {{-- Mode Invité --}}
                    <div style="background: rgba(255,255,255,0.05); padding: 10px; border-radius: 8px;">
                        <p style="color: #818cf8; font-size: 0.85rem; margin-bottom: 5px;">Mode Lecture Seule</p>
                        <a href="{{ route('login') }}" style="color: white; font-size: 0.8rem; text-decoration: underline;">Connectez-vous pour réserver</a>
                    </div>
                @endauth
            </div>

            {{-- Section Signalement (Utilisateur Uniquement) --}}
            @auth
                @if(auth()->user()->role === 'user')
                <div style="background: rgba(244, 63, 94, 0.05); border: 1px solid rgba(244, 63, 94, 0.2); padding: 12px; border-radius: 12px; margin-top: 10px;">
                    <h4 style="color: var(--accent-red); font-size: 0.8rem; text-transform: uppercase; margin-bottom: 8px;">⚠️ Signaler un incident</h4>
                    <form action="{{ route('incidents.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="resource_id" value="{{ $resource->id }}">
                        <input type="text" name="subject" placeholder="Sujet" required style="width: 100%; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: white; padding: 6px; border-radius: 6px; margin-bottom: 5px; font-size: 0.8rem;">
                        <textarea name="description" placeholder="Détails..." required style="width: 100%; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: white; padding: 6px; border-radius: 6px; font-size: 0.8rem; height: 50px; resize: none;"></textarea>
                        <button type="submit" class="logout-btn" style="width: 100%; margin-top: 8px; padding: 8px; font-size: 0.75rem; font-weight: bold;">Signaler</button>
                    </form>
                </div>
                @endif
            @endauth
        </div>
    </div>
    @endforeach
</div>
@endsection