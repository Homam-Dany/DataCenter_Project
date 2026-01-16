@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 30px; max-width: 1000px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <div>
            <h1 class="logo-text">Mon Historique <span>Data Center</span></h1>
            <p style="color: var(--text-muted);">Consultez et filtrez vos réservations passées et en cours.</p>
        </div>
        <a href="{{ route('reservations.create') }}" class="btn-primary" style="text-decoration: none; padding: 12px 24px; border-radius: 10px; font-weight: 600;">Nouvelle Réservation</a>
    </div>

    <div class="card" style="background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); padding: 20px; border-radius: 15px; margin-bottom: 30px;">
        <form action="{{ route('reservations.index') }}" method="GET" style="display: flex; gap: 15px; align-items: flex-end; flex-wrap: wrap;">
            
            <div style="flex: 1; min-width: 200px;">
                <label style="color: #818cf8; font-size: 0.75rem; font-weight: bold; text-transform: uppercase; margin-bottom: 8px; display: block;">Ressource</label>
                <input type="text" name="resource" value="{{ request('resource') }}" placeholder="Ex: Serveur AI..." 
                       style="width: 100%; background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.1); color: white; padding: 10px; border-radius: 8px; outline: none;">
            </div>

            <div style="flex: 1; min-width: 150px;">
                <label style="color: #818cf8; font-size: 0.75rem; font-weight: bold; text-transform: uppercase; margin-bottom: 8px; display: block;">État</label>
                <select name="status" style="width: 100%; background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.1); color: white; padding: 10px; border-radius: 8px; outline: none; cursor: pointer;">
                    <option value="">Tous les états</option>
                    <option value="en_attente" {{ request('status') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                    <option value="Approuvée" {{ request('status') == 'Approuvée' ? 'selected' : '' }}>Approuvée</option>
                    <option value="Refusée" {{ request('status') == 'Refusée' ? 'selected' : '' }}>Refusée</option>
                    <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Terminée" {{ request('status') == 'Terminée' ? 'selected' : '' }}>Terminée</option>
                </select>
            </div>

            <div style="flex: 1; min-width: 150px;">
                <label style="color: #818cf8; font-size: 0.75rem; font-weight: bold; text-transform: uppercase; margin-bottom: 8px; display: block;">Date</label>
                <input type="date" name="date" value="{{ request('date') }}" 
                       style="width: 100%; background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.1); color: white; padding: 10px; border-radius: 8px; outline: none;">
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit" class="btn-primary" style="padding: 10px 20px; border-radius: 8px; cursor: pointer; border: none;">Filtrer</button>
                <a href="{{ route('reservations.index') }}" class="btn" style="background: rgba(255,255,255,0.1); color: white; padding: 10px 15px; border-radius: 8px; text-decoration: none; font-size: 0.9rem;">Reset</a>
            </div>
        </form>
    </div>

    <div class="grid" style="display: grid; gap: 20px;">
        @forelse($allReservations as $res)
            <div class="card" style="background: rgba(30, 41, 59, 0.5); border: 1px solid rgba(255,255,255,0.1); padding: 20px; border-radius: 15px;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <h3 style="color: #818cf8; margin: 0;">{{ $res->resource->name }}</h3>
                        <p style="color: var(--text-muted); font-size: 0.8rem; margin-top: 5px;">
                            <strong>Période :</strong> Du {{ $res->start_date->format('d/m/Y') }} au {{ $res->end_date->format('d/m/Y') }}
                        </p>
                    </div>
                    
                    @php
                        $badgeColor = '#f59e0b';
                        $statusLabel = $res->status;

                        if($res->status == 'Approuvée' && now()->between($res->start_date, $res->end_date)) {
                            $badgeColor = '#3b82f6';
                            $statusLabel = 'Active';
                        } elseif($res->status == 'Approuvée') {
                            $badgeColor = '#10b981';
                        } elseif($res->status == 'Terminée') {
                            $badgeColor = '#64748b';
                        } elseif($res->status == 'Refusée') {
                            $badgeColor = '#f43f5e';
                        }
                    @endphp

                    <span style="background: {{ $badgeColor }}; color: white; padding: 6px 14px; border-radius: 20px; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">
                        {{ $statusLabel }}
                    </span>
                </div>

                <div style="margin-top: 15px; background: rgba(0,0,0,0.2); padding: 12px; border-radius: 10px; border-left: 3px solid #818cf8;">
                    <strong style="color: #818cf8; font-size: 0.75rem; text-transform: uppercase;">Justification fournie :</strong>
                    <p style="color: #cbd5e1; font-size: 0.85rem; margin-top: 6px; font-style: italic; line-height: 1.4;">"{{ $res->justification }}"</p>
                </div>

                {{-- NOUVEAU : Affichage du motif de refus (Point 2.3 et 3.3) --}}
                @if($res->status == 'Refusée' && $res->rejection_reason)
                    <div style="margin-top: 15px; background: rgba(244, 63, 94, 0.1); border: 1px solid rgba(244, 63, 94, 0.2); padding: 12px; border-radius: 10px; border-left: 3px solid #f43f5e;">
                        <strong style="color: #f43f5e; font-size: 0.75rem; text-transform: uppercase;">Motif du refus :</strong>
                        <p style="color: #fca5a5; font-size: 0.85rem; margin-top: 6px; font-style: italic;">"{{ $res->rejection_reason }}"</p>
                    </div>
                @endif

                <div style="margin-top: 15px; display: flex; justify-content: flex-end; gap: 15px; align-items: center;">
                    <a href="#" title="Signaler un incident" style="color: #f59e0b; text-decoration: none; font-size: 0.8rem; display: flex; align-items: center; gap: 5px;">
                        ⚠️ <span style="text-decoration: underline;">Signaler un problème</span>
                    </a>

                    @if($res->status == 'en_attente')
                        <form action="{{ route('reservations.destroy', $res->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment annuler cette demande ?')">
                            @csrf @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #f43f5e; cursor: pointer; font-size: 0.8rem; text-decoration: underline; font-weight: 600;">
                                Annuler la demande
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="card" style="text-align: center; padding: 60px; color: var(--text-muted); background: rgba(255,255,255,0.02); border: 1px dashed rgba(255,255,255,0.1); border-radius: 20px;">
                <p style="font-size: 1.1rem;">🔍 Aucune réservation ne correspond à vos critères.</p>
                <a href="{{ route('reservations.index') }}" style="color: #818cf8; text-decoration: underline; font-size: 0.9rem;">Effacer les filtres</a>
            </div>
        @endforelse
    </div>
</div>
@endsection