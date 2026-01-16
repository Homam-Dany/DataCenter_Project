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

    {{-- Liste des notifications non lues --}}
    @forelse(auth()->user()->unreadNotifications as $notification)
        @php
            $status = $notification->data['status'] ?? 'Info';
            $borderColor = ($status === 'Refusée') ? '#ef4444' : 'var(--accent-cyan)';
        @endphp

        <div class="card" style="margin-bottom: 1.5rem; border-left: 4px solid {{ $borderColor }}; padding: 1.5rem;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div style="flex-grow: 1;">
                    <p style="margin: 0; font-weight: 600; color: var(--text-main); font-size: 1.05rem;">
                       {{ $notification->data['message'] ?? 'Nouvelle mise à jour reçue' }}
                    </p>

                    {{-- 1. Affichage du motif de REFUS (pour l'utilisateur) --}}
                    @if(isset($notification->data['rejection_reason']) && $status === 'Refusée')
                        <div style="margin-top: 12px; padding: 12px; background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); border-radius: 8px;">
                            <span style="display: block; font-size: 0.75rem; color: #ef4444; text-transform: uppercase; font-weight: 800; margin-bottom: 5px;">Motif du refus :</span>
                            <p style="margin: 0; color: #fca5a5; font-style: italic; font-size: 0.95rem;">
                                "{{ $notification->data['rejection_reason'] }}"
                            </p>
                        </div>
                    @endif

                    {{-- 2. Affichage de la JUSTIFICATION DU BESOIN (pour rappel ou pour le manager) --}}
                    @if(isset($notification->data['justification']))
                        <div style="margin-top: 10px; padding: 12px; background: rgba(0,0,0,0.2); border-radius: 8px; border-left: 3px solid #818cf8;">
                            <span style="display: block; font-size: 0.75rem; color: #818cf8; text-transform: uppercase; font-weight: 800; margin-bottom: 5px;">Justification du besoin :</span>
                            <p style="margin: 0; color: #cbd5e1; font-style: italic; font-size: 0.95rem;">
                                "{{ $notification->data['justification'] }}"
                            </p>
                        </div>
                    @endif

                    <small style="color: var(--text-muted); display: block; margin-top: 10px;">
                        {{ $notification->created_at->diffForHumans() }}
                    </small>
                </div>
            </div>

            {{-- 3. SECTION ACTIONS (Manager/Admin uniquement si en attente) --}}
            @if(isset($notification->data['reservation_id']))
                @php
                    $reservation = \App\Models\Reservation::find($notification->data['reservation_id']);
                @endphp

                @if($reservation && $reservation->status === 'en_attente' && in_array(auth()->user()->role, ['admin', 'responsable']))
                    <div style="margin-top: 15px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 15px;">
                        <form id="decision-form-{{ $reservation->id }}" action="" method="POST">
                            @csrf
                            
                            <div id="rejection-area-{{ $reservation->id }}" style="display: none; margin-bottom: 15px;">
                                <label style="color: #ef4444; font-size: 0.8rem; font-weight: bold; text-transform: uppercase; display: block; margin-bottom: 5px;">
                                    Motif du refus (Obligatoire) :
                                </label>
                                <textarea name="rejection_reason" id="reason-input-{{ $reservation->id }}"
                                    placeholder="Expliquez pourquoi la demande est refusée..."
                                    style="width: 100%; background: rgba(0,0,0,0.3); border: 1px solid #ef4444; color: white; padding: 10px; border-radius: 8px; font-size: 0.9rem; resize: none; min-height: 80px;"></textarea>
                            </div>

                            <div style="display: flex; gap: 10px;">
                                <button type="button" class="btn" onclick="submitDecision({{ $reservation->id }}, 'accepter')" 
                                    style="background-color: #10b981; color: white; padding: 8px 15px; cursor: pointer; border: none; border-radius: 5px; font-weight: bold;">
                                    ACCEPTER
                                </button>

                                <button type="button" id="refuse-btn-{{ $reservation->id }}" class="btn" onclick="handleRefusal({{ $reservation->id }})" 
                                    style="background-color: #ef4444; color: white; padding: 8px 15px; cursor: pointer; border: none; border-radius: 5px; font-weight: bold;">
                                    REFUSER
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            @endif
        </div>
    @empty
        <div class="card" style="text-align: center; padding: 3rem; border-style: dashed;">
            <p style="color: var(--text-muted); margin: 0;">Aucune nouvelle notification. Tout est traité !</p>
        </div>
    @endforelse
</div>

<script>
function submitDecision(id, action) {
    const form = document.getElementById('decision-form-' + id);
    form.action = "/reservations/decide/" + id + "/" + action;
    form.submit();
}

function handleRefusal(id) {
    const area = document.getElementById('rejection-area-' + id);
    const input = document.getElementById('reason-input-' + id);
    const btn = document.getElementById('refuse-btn-' + id);

    if (area.style.display === 'none') {
        area.style.display = 'block';
        btn.innerText = "CONFIRMER LE REFUS";
        input.focus();
    } else {
        if (input.value.trim().length < 5) {
            alert("Veuillez saisir un motif de refus valide (5 caractères min).");
            return;
        }
        submitDecision(id, 'refuser');
    }
}
</script>
@endsection