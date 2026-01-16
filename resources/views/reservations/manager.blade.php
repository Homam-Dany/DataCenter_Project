@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 30px; color: white; padding: 20px;">
    <h1 style="margin-bottom: 25px;">Gestion des <span style="color: #818cf8;">Demandes</span></h1>

    @if(session('success'))
        <div style="background: rgba(16, 185, 129, 0.2); border: 1px solid #10b981; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="display: flex; flex-direction: column; gap: 30px;">
        @forelse($pendingReservations as $res)
            <div style="background: #1e293b; border: 2px solid #334155; padding: 25px; border-radius: 12px;">
                <div style="margin-bottom: 20px;">
                    <h2 style="color: #818cf8; margin: 0;">{{ $res->resource->name }}</h2>
                    <p style="margin-top: 5px;">Demandeur : <strong>{{ $res->user->name }}</strong></p>
                    
                    {{-- Affichage clair de la justification pour le responsable --}}
                    <div style="margin-top: 15px; background: rgba(0,0,0,0.3); border-left: 4px solid #818cf8; padding: 15px; border-radius: 5px;">
                        <strong style="color: #818cf8; display: block; margin-bottom: 5px; font-size: 0.8rem; text-transform: uppercase;">Justification du client :</strong>
                        <p style="font-style: italic; color: #cbd5e1; margin: 0; line-height: 1.5;">
                            "{{ $res->justification }}"
                        </p>
                    </div>
                </div>

                <div style="border-top: 1px solid #334155; padding-top: 20px;">
                    <form action="{{ route('reservations.decide', ['id' => $res->id, 'action' => 'accepter']) }}" method="POST" style="margin-bottom: 15px;">
                        @csrf
                        <button type="submit" style="background: #10b981; color: white; border: none; padding: 12px; border-radius: 5px; font-weight: bold; cursor: pointer; width: 100%;">
                            ✅ ACCEPTER LA DEMANDE
                        </button>
                    </form>

                    <form action="{{ route('reservations.decide', ['id' => $res->id, 'action' => 'refuser']) }}" method="POST">
                        @csrf
                        <label for="reason_{{ $res->id }}" style="display: block; color: #f43f5e; font-weight: bold; margin-bottom: 8px;">
                            Justification du refus obligatoire :
                        </label>
                        
                        <textarea 
                            id="reason_{{ $res->id }}"
                            name="rejection_reason" 
                            required 
                            placeholder="Saisissez la raison du refus..." 
                            style="width: 100%; background: #0f172a; border: 1px solid #f43f5e; color: white; padding: 12px; border-radius: 8px; min-height: 80px; margin-bottom: 5px; outline: none;"></textarea>
                        
                        @error('rejection_reason')
                            <p style="color: #f43f5e; font-size: 0.85rem; margin-bottom: 10px;">{{ $message }}</p>
                        @enderror

                        <button type="submit" style="background: #f43f5e; color: white; border: none; padding: 10px; border-radius: 5px; font-weight: bold; cursor: pointer; width: 100%;">
                            ❌ CONFIRMER LE REFUS
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p style="text-align: center; color: #94a3b8;">Aucune demande en attente.</p>
        @endforelse
    </div>
</div>
@endsection