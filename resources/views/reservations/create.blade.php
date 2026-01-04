@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <h1>Faire une demande de réservation</h1>
        <p style="color: var(--secondary); margin-bottom: 20px;">
            Sélectionnez une ressource et les dates souhaitées pour votre projet.
        </p>

        @if ($errors->any())
            <div class="alert alert-danger" style="color: var(--danger); background: #fed7d7; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reservations.store') }}" method="POST" class="auth-content">
            @csrf

            <div class="form-group">
                <label for="resource_id">Ressource :</label>
                <select name="resource_id" id="resource_id" required style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px; margin-bottom: 20px;">
                    <option value="">-- Choisir une ressource --</option>
                    @foreach($resources as $resource)
                        <option value="{{ $resource->id }}" 
                                data-cpu="{{ $resource->cpu }}" 
                                data-ram="{{ $resource->ram }}" 
                                data-storage="{{ $resource->storage_capacity }}Go {{ $resource->storage_type }}" 
                                data-os="{{ $resource->os }}">
                            {{ $resource->name ?? 'Nom non défini' }} ({{ $resource->type }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div id="resource-details-display" style="display: none;"></div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label for="start_date">Date début :</label>
                    <input type="date" name="start_date" id="start_date" required>
                </div>

                <div class="form-group">
                    <label for="end_date">Date fin :</label>
                    <input type="date" name="end_date" id="end_date" required>
                </div>
            </div>

            <div class="form-group" style="margin-top: 10px;">
                <label for="justification">Justification (optionnel) :</label>
                <textarea name="justification" id="justification" rows="4" placeholder="Expliquez votre besoin..." style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px;"></textarea>
            </div>

            <div style="margin-top: 20px;">
                <button type="submit" class="btn btn-primary">Envoyer la demande</button>
                <a href="{{ route('resources.index') }}" class="btn btn-logout" style="text-align:center; display:inline-block; margin-left: 10px; text-decoration: none;">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection