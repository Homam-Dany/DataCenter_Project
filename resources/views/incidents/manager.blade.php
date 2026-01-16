@extends('layouts.app')

@section('content')
<div class="main-content">
    <div style="margin-bottom: 30px;">
        <h1 class="title-gradient">Modération des Alertes Techniques</h1>
        <p style="color: var(--text-muted);">Suivi des problèmes signalés par les utilisateurs internes sur vos ressources.</p>
    </div>

    @if(session('success'))
        <div style="background: rgba(16, 185, 129, 0.15); border: 1px solid #10b981; color: #10b981; padding: 15px; border-radius: 12px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card" style="background: rgba(30, 41, 59, 0.4); border: 1px solid rgba(255,255,255,0.1); border-radius: 15px; overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; color: white;">
            <thead>
                <tr style="text-align: left; background: rgba(0,0,0,0.2);">
                    <th style="padding: 20px;">Ressource</th>
                    <th style="padding: 20px;">Utilisateur</th>
                    <th style="padding: 20px;">Détails de l'incident</th>
                    <th style="padding: 20px;">Statut</th>
                    <th style="padding: 20px; text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($incidents as $incident)
                <tr style="border-bottom: 1px solid rgba(255,255,255,0.05); transition: 0.3s;" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
                    <td style="padding: 20px;">
                        <span style="color: var(--accent-cyan); font-weight: 800; text-transform: uppercase; font-size: 0.85rem;">{{ $incident->resource->name }}</span>
                    </td>
                    <td style="padding: 20px;">
                        <div style="display: flex; flex-direction: column;">
                            <span style="font-weight: 600;">{{ $incident->user->name }}</span>
                            <small style="color: var(--text-muted);">{{ $incident->user->email }}</small>
                        </div>
                    </td>
                    <td style="padding: 20px;">
                        <strong style="color: #cbd5e1;">{{ $incident->subject }}</strong><br>
                        <p style="color: var(--text-muted); font-size: 0.85rem; margin-top: 5px; line-height: 1.4;">{{ $incident->description }}</p>
                    </td>
                    <td style="padding: 20px;">
                        @php
                            $isOuvert = $incident->status === 'ouvert';
                        @endphp
                        <span style="padding: 5px 12px; border-radius: 20px; font-size: 0.7rem; font-weight: bold; text-transform: uppercase; 
                                     background: {{ $isOuvert ? 'rgba(244, 63, 94, 0.2)' : 'rgba(16, 185, 129, 0.2)' }}; 
                                     color: {{ $isOuvert ? '#f43f5e' : '#10b981' }}; border: 1px solid {{ $isOuvert ? '#f43f5e' : '#10b981' }};">
                            {{ $incident->status }}
                        </span>
                    </td>
                    <td style="padding: 20px; text-align: center;">
                        @if($incident->status === 'ouvert')
                        <form action="{{ route('incidents.resolve', $incident) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn-primary" style="padding: 8px 15px; font-size: 0.75rem; border-radius: 8px; text-transform: uppercase; font-weight: bold;">
                                Résoudre
                            </button>
                        </form>
                        @else
                            <span style="color: #10b981; font-size: 0.9rem; font-weight: bold;">✅ Traité</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding: 50px; text-align: center; color: var(--text-dim);">
                        <div style="font-size: 3rem; margin-bottom: 10px;">☕</div>
                        Aucun incident technique à modérer pour vos ressources.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection