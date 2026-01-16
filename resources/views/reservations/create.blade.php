@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 800px; padding: 40px 20px;">
    <div class="card" style="background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(15px); border: 1px solid rgba(255,255,255,0.08); padding: 40px; border-radius: 24px;">
        
        <h1 class="title-gradient" style="font-size: 2.5rem; margin-bottom: 10px;">Réserver une Ressource</h1>
        <p style="color: var(--text-muted); margin-bottom: 35px; font-weight: 500;">
            Planifiez votre allocation de ressources Data Center en quelques secondes.
        </p>

        @if ($errors->any())
            <div style="background: rgba(244, 63, 94, 0.1); border: 1px solid #f43f5e; color: #f43f5e; padding: 15px; border-radius: 12px; margin-bottom: 25px; font-weight: 600;">
                <ul style="margin: 0; list-style: none; padding: 0;">
                    @foreach ($errors->all() as $error)
                        <li>⚠️ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf

            <div class="form-group" style="margin-bottom: 25px;">
                <label style="color: white; font-weight: 700; display: block; margin-bottom: 10px; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">Choisir l'équipement</label>
                <select name="resource_id" id="resource_id" required 
                    style="width: 100%; background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.1); color: white; padding: 15px; border-radius: 12px; font-size: 1rem; cursor: pointer; transition: 0.3s; outline: none;"
                    onchange="updateDetails(this)">
                    <option value="" style="background: #0f172a;">-- Liste des ressources disponibles --</option>
                    @foreach($resources as $resource)
                        <option value="{{ $resource->id }}" 
                                data-cpu="{{ $resource->cpu }}" 
                                data-ram="{{ $resource->ram }}" 
                                data-storage="{{ $resource->storage_capacity }}Go"
                                data-os="{{ $resource->os }}"
                                style="background: #0f172a;">
                            {{ $resource->name }} ({{ $resource->type }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div id="preview-card" style="display: none; background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(168, 85, 247, 0.1)); border: 1px dashed rgba(129, 140, 248, 0.5); border-radius: 15px; padding: 20px; margin-bottom: 25px;">
                <h4 style="color: #818cf8; margin-top: 0;">Spécifications techniques :</h4>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; color: white; font-size: 0.9rem;">
                    <div>💻 OS: <span id="p-os" style="font-weight: bold;"></span></div>
                    <div>🧠 CPU: <span id="p-cpu" style="font-weight: bold;"></span> Cores</div>
                    <div>💾 RAM: <span id="p-ram" style="font-weight: bold;"></span> GB</div>
                    <div>💿 Disque: <span id="p-storage" style="font-weight: bold;"></span></div>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                <div class="form-group">
                    <label style="color: white; font-weight: 700; display: block; margin-bottom: 10px; font-size: 0.8rem; text-transform: uppercase;">Date de début</label>
                    <input type="date" name="start_date" id="start_date" required 
                        style="width: 100%; background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.1); color: white; padding: 12px; border-radius: 10px;">
                </div>
                <div class="form-group">
                    <label style="color: white; font-weight: 700; display: block; margin-bottom: 10px; font-size: 0.8rem; text-transform: uppercase;">Date de fin</label>
                    <input type="date" name="end_date" id="end_date" required
                        style="width: 100%; background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.1); color: white; padding: 12px; border-radius: 10px;">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 30px;">
                <label style="color: white; font-weight: 700; display: block; margin-bottom: 10px; font-size: 0.8rem; text-transform: uppercase;">Justification du besoin</label>
                {{-- Correction : L'attribut name="justification" est crucial ici --}}
                <textarea name="justification" rows="3" required placeholder="Expliquez pourquoi vous avez besoin de cette ressource..."
                    style="width: 100%; background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.1); color: white; padding: 15px; border-radius: 12px; resize: none;">{{ old('justification') }}</textarea>
            </div>

            <div style="display: flex; gap: 15px; align-items: center;">
                <button type="submit" class="btn-primary" style="flex: 2; padding: 16px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">
                    Confirmer la réservation
                </button>
                <a href="{{ route('resources.index') }}" style="flex: 1; text-align: center; color: var(--text-muted); text-decoration: none; font-weight: 600;">Annuler</a>
            </div>
        </form>
    </div>
</div>

<script>
function updateDetails(select) {
    const preview = document.getElementById('preview-card');
    const option = select.options[select.selectedIndex];
    
    if(select.value) {
        preview.style.display = 'block';
        document.getElementById('p-cpu').innerText = option.getAttribute('data-cpu');
        document.getElementById('p-ram').innerText = option.getAttribute('data-ram');
        document.getElementById('p-storage').innerText = option.getAttribute('data-storage');
        document.getElementById('p-os').innerText = option.getAttribute('data-os');
    } else {
        preview.style.display = 'none';
    }
}
</script>
@endsection