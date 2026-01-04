@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 30px;">
    <div class="header-section">
        <h1 class="logo-text">Règles d'<span>Utilisation</span></h1>
        <p class="subtitle">Conditions générales d'accès et d'exploitation des ressources du Data Center.</p>
    </div>

    <div class="resources-grid" style="margin-top: 30px;">
        <div class="resource-card" style="padding: 20px;">
            <div style="display: flex; align-items: center; margin-bottom: 15px;">
                <span class="badge disponible" style="margin-right: 10px;">01</span>
                <h3 style="margin: 0;">Éligibilité</h3>
            </div>
            <p style="color: var(--secondary); font-size: 0.95rem;">
                L'accès aux ressources est réservé aux enseignants, chercheurs et doctorants disposant d'un compte actif validé par l'administration.
            </p>
        </div>

        <div class="resource-card" style="padding: 20px;">
            <div style="display: flex; align-items: center; margin-bottom: 15px;">
                <span class="badge disponible" style="margin-right: 10px;">02</span>
                <h3 style="margin: 0;">Réservations</h3>
            </div>
            <p style="color: var(--secondary); font-size: 0.95rem;">
                Toute demande doit être accompagnée d'une justification précise. Les réservations sont limitées dans le temps pour garantir un partage équitable.
            </p>
        </div>

        <div class="resource-card" style="padding: 20px;">
            <div style="display: flex; align-items: center; margin-bottom: 15px;">
                <span class="badge maintenance" style="margin-right: 10px;">03</span>
                <h3 style="margin: 0;">Maintenance</h3>
            </div>
            <p style="color: var(--secondary); font-size: 0.95rem;">
                Les responsables techniques se réservent le droit de suspendre l'accès à une ressource pour des opérations de maintenance planifiées ou urgentes.
            </p>
        </div>
    </div>

    <div class="card" style="margin-top: 30px; background: white; padding: 25px; border-radius: 12px; box-shadow: var(--shadow);">
        <h3>Assistance Technique</h3>
        <p style="color: var(--secondary); margin-top: 10px;">
            En cas de problème ou d'incident technique sur une ressource active, les utilisateurs doivent le signaler immédiatement via leur espace personnel.
        </p>
        @guest
            <div style="margin-top: 20px; border-top: 1px solid #edf2f7; pt: 20px;">
                <p>Vous n'avez pas encore de compte ?</p>
                <a href="{{ route('register') }}" class="btn btn-primary" style="margin-top: 10px;">Déposer une demande d'ouverture</a>
            </div>
        @endguest
    </div>
</div>
@endsection