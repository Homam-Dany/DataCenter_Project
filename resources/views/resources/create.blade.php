@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="auth-page">
        <div class="card auth-card" style="max-width: 600px; margin: 0 auto;">
            <div class="auth-logo">
                <h2 class="logo-text">Ajouter une <span>Ressource</span></h2>
                <p style="color: var(--text-muted); font-size: 0.9rem;">Enregistrement d'un nouvel équipement dans le parc.</p>
            </div>

            <form action="{{ route('resources.store') }}" method="POST" style="margin-top: 20px;">
                @csrf
                
                <div class="form-group" style="margin-bottom: 15px;">
                    <label style="color: white; display: block; margin-bottom: 5px;">Nom de l'équipement</label>
                    <input type="text" name="name" placeholder="ex: Serveur Dell PowerEdge" required 
                        style="width: 100%; background: #0f172a; border: 1px solid var(--glass-border); color: white; padding: 10px; border-radius: 8px;">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 15px;">
                    <div class="form-group">
                        <label style="color: white; display: block; margin-bottom: 5px;">CPU (Cœurs)</label>
                        <input type="number" name="cpu" required min="1"
                            style="width: 100%; background: #0f172a; border: 1px solid var(--glass-border); color: white; padding: 10px; border-radius: 8px;">
                    </div>
                    <div class="form-group">
                        <label style="color: white; display: block; margin-bottom: 5px;">RAM (Go)</label>
                        <input type="number" name="ram" required min="1"
                            style="width: 100%; background: #0f172a; border: 1px solid var(--glass-border); color: white; padding: 10px; border-radius: 8px;">
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label style="color: white; display: block; margin-bottom: 5px;">Type de ressource</label>
                    <select name="type" style="width: 100%; background: #0f172a; border: 1px solid var(--glass-border); color: white; padding: 10px; border-radius: 8px;">
                        <option value="Serveur">Serveur Physique</option>
                        <option value="VM">Machine Virtuelle</option>
                        <option value="Switch">Switch Réseau</option>
                        <option value="Stockage">Baie de Stockage</option>
                    </select>
                </div>

                <div class="form-group" style="margin-bottom: 25px;">
                    <label style="color: white; display: block; margin-bottom: 5px;">Catégorie</label>
                    <input type="text" name="category" placeholder="ex: Calcul haute performance" required
                        style="width: 100%; background: #0f172a; border: 1px solid var(--glass-border); color: white; padding: 10px; border-radius: 8px;">
                </div>

                <div class="auth-footer" style="display: flex; flex-direction: column; gap: 10px;">
                    <button type="submit" class="btn-primary" style="width: 100%; padding: 12px; font-weight: bold; border: none; cursor: pointer;">
                        💾 ENREGISTRER DANS LE PARC
                    </button>
                    <a href="{{ route('resources.index') }}" style="text-align: center; color: var(--text-muted); text-decoration: none; font-size: 0.9rem;">
                        Annuler et revenir au catalogue
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection