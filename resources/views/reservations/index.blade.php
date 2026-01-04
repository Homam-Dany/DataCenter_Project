@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 30px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <div>
            <h1 class="logo-text">Mes <span>Réservations</span></h1>
            <p style="color: var(--secondary);">Suivi en temps réel de vos demandes et historique.</p>
        </div>
        <a href="{{ route('reservations.create') }}" class="btn btn-primary">Nouvelle Réservation</a>
    </div>

    <div class="card" style="background: white; border-radius: 12px; box-shadow: var(--shadow); overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead style="background: #f8fafc; border-bottom: 2px solid #edf2f7;">
                <tr>
                    <th style="padding: 15px; text-align: left;">Ressource</th>
                    <th style="padding: 15px; text-align: left;">Période</th>
                    <th style="padding: 15px; text-align: left;">Statut</th>
                    <th style="padding: 15px; text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservations as $reservation)
                    <tr style="border-bottom: 1px solid #edf2f7;">
                        <td style="padding: 15px;">
                            <strong>{{ $reservation->resource->name }}</strong><br>
                            <small style="color: #a0aec0;">{{ $reservation->resource->type }}</small>
                        </td>
                        <td style="padding: 15px;">
                            <small>Du: {{ $reservation->start_date->format('d/m/Y H:i') }}</small><br>
                            <small>Au: {{ $reservation->end_date->format('d/m/Y H:i') }}</small>
                        </td>
                        <td style="padding: 15px;">
                            {{-- Gestion des badges de l'énoncé --}}
                            <span class="badge {{ strtolower($reservation->status) }}">
                                {{ $reservation->status }}
                            </span>
                        </td>
                        <td style="padding: 15px; text-align: center;">
                            @if($reservation->status == 'en_attente')
                                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button class="confirm-action" style="color: var(--danger); background:none; border:none; cursor:pointer; font-size: 0.8rem;">
                                        <i class="fas fa-trash"></i> Annuler
                                    </button>
                                </form>
                            @endif
                            <button title="Signaler un incident" style="color: var(--warning); background:none; border:none; margin-left:10px;">
                                <i class="fas fa-exclamation-triangle"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding: 40px; text-align: center; color: #a0aec0;">
                            Vous n'avez aucune réservation pour le moment.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection