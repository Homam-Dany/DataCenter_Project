@extends('layouts.app')

@section('content')
<div class="main-content">
    {{-- En-tête de la page --}}
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div>
            <h1 style="color: var(--text-main);">Mes Notifications</h1>
            <p style="color: var(--text-muted);">Suivi de vos demandes de réservation et alertes techniques.</p>
        </div>
        
        @if(auth()->user()->unreadNotifications->count() > 0)
            <form action="{{ route('notifications.markRead') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary" style="font-size: 0.8rem; padding: 10px 20px;">
                    Tout marquer comme lu
                </button>
            </form>
        @endif
    </div>

    {{-- Liste unique des notifications --}}
    @forelse(auth()->user()->notifications as $notification)
        <div class="card" style="margin-bottom: 1.5rem; border-left: 4px solid {{ $notification->unread() ? 'var(--accent-cyan)' : 'var(--glass-border)' }}; padding: 1.5rem;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div style="flex-grow: 1;">
                    {{-- Texte de la notification corrigé pour éviter l'erreur "message" --}}
                    <p style="margin: 0; font-weight: 600; color: var(--text-main); font-size: 1.05rem;">
                       {{ $notification->data['message'] ?? 'Nouvelle demande de réservation reçue' }}
                    </p>
                    <small style="color: var(--text-muted); display: block; margin-top: 5px;">
                        {{ $notification->created_at->diffForHumans() }}
                    </small>
                </div>
                
                @if($notification->unread())
                    <span class="badge disponible" style="background: rgba(59, 130, 246, 0.1); color: var(--accent-cyan); border: 1px solid var(--accent-cyan);">Nouveau</span>
                @endif
            </div>

            {{-- Section Actions pour le Responsable --}}
            @if(isset($notification->data['reservation_id']))
                <div style="display: flex; gap: 10px;">
    {{-- Formulaire Accepter --}}
    <form action="{{ route('reservations.decide', ['id' => $notification->data['reservation_id'], 'action' => 'accepter']) }}" method="POST">
        @csrf
        <button type="submit" class="btn" style="background-color: #10b981; color: white;">
            ACCEPTER
        </button>
    </form>

    {{-- Formulaire Refuser --}}
    <form action="{{ route('reservations.decide', ['id' => $notification->data['reservation_id'], 'action' => 'refuser']) }}" method="POST">
        @csrf
        <button type="submit" class="btn" style="background-color: #ef4444; color: white;">
            REFUSER
        </button>
    </form>
</div>
            @endif
        </div>
    @empty
        <div class="card" style="text-align: center; padding: 3rem; border-style: dashed;">
            <p style="color: var(--text-muted); margin: 0;">Aucune notification pour le moment.</p>
        </div>
    @endforelse
</div>
@endsection