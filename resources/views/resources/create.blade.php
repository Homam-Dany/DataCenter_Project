@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="auth-page">
        <div class="card auth-card" style="max-width: 600px;">
            <div class="auth-logo">
                <h2 class="logo-text">Ajouter une <span>Ressource</span></h2>
            </div>

            <form action="{{ route('resources.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label>Nom de l'équipement</label>
                    <input type="text" name="name" placeholder="ex: Serveur Dell R740" required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label>CPU (Cœurs)</label>
                        <input type="number" name="cpu" required>
                    </div>
                    <div class="form-group">
                        <label>RAM (Go)</label>
                        <input type="number" name="ram" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Type de ressource</label>
                    <select name="type">
                        <option value="Serveur">Serveur</option>
                        <option value="Switch">Switch</option>
                        <option value="Stockage">Stockage</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Catégorie</label>
                    <input type="text" name="category" placeholder="ex: Calcul, Réseau..." required>
                </div>

                <div class="auth-footer">
                    <button type="submit" class="btn btn-primary" style="width: 100%;">
                        Enregistrer dans le parc
                    </button>
                    <a href="{{ route('resources.manager') }}">Annuler et revenir</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection