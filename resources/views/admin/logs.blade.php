@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 30px;">
    <div class="header-section" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <div>
            <h1 class="logo-text">Journal de <span>Traçabilité</span></h1>
            <p style="color: var(--secondary);">Audit complet des actions effectuées sur la plateforme.</p>
        </div>
        {{-- Correction : Affichage du nombre total de logs au lieu d'une variable $log non définie hors de la boucle --}}
        <span class="badge" style="background: var(--accent); color: white; padding: 10px 20px; border-radius: 50px;">
            {{ $logs->total() }} événements
        </span>
    </div>

    <div style="margin-bottom: 20px;">
        <input type="text" id="logSearch" onkeyup="filterLogs()" placeholder="Rechercher une action, un utilisateur..." 
               style="width: 100%; max-width: 400px; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: var(--shadow);">
    </div>

    <div class="card" style="background: var(--white); border-radius: 12px; box-shadow: var(--shadow); overflow: hidden;">
        <table id="logTable" style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: var(--light); color: var(--primary);">
                    <th style="padding: 15px; border-bottom: 2px solid #e2e8f0;">Date & Heure</th>
                    <th style="padding: 15px; border-bottom: 2px solid #e2e8f0;">Action</th>
                    <th style="padding: 15px; border-bottom: 2px solid #e2e8f0;">Description</th>
                    <th style="padding: 15px; border-bottom: 2px solid #e2e8f0;">Utilisateur</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                    <tr style="border-bottom: 1px solid #edf2f7; transition: background 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                        <td style="padding: 15px; font-size: 0.85rem; white-space: nowrap;">
                            {{ $log->created_at->format('d/m/Y H:i:s') }}
                        </td>
                        <td style="padding: 15px;">
                            <span class="log-action action-{{ Str::slug($log->action) }}" style="font-weight: bold; font-size: 0.9rem; text-transform: uppercase;">
                                {{ $log->action }}
                            </span>
                        </td>
                        <td style="padding: 15px; color: var(--secondary); font-size: 0.9rem;">
                            {{ $log->description }}
                        </td>
                        <td style="padding: 15px;">
                            <div style="display: flex; flex-direction: column;">
                                <strong>{{ $log->user->name ?? 'Système' }}</strong>
                                <small style="color: #a0aec0;">{{ ucfirst($log->user->role ?? 'automatique') }}</small>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 50px; color: #a0aec0;">
                            Aucune action enregistrée dans le journal.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Ajout de la pagination pour la navigation --}}
    <div style="margin-top: 20px;">
        {{ $logs->links() }}
    </div>
</div>

<style>
    /* Coloration dynamique des types d'actions */
    .log-action { font-size: 0.8rem; }
    .action-reservation { color: var(--accent); }
    .action-modification-utilisateur { color: #805ad5; } /* Violet */
    .action-changement-etat { color: var(--warning); }
    .action-ajout-ressource { color: var(--success); }
</style>

<script>
    function filterLogs() {
        let input = document.getElementById('logSearch');
        let filter = input.value.toUpperCase();
        let table = document.getElementById('logTable');
        let tr = table.getElementsByTagName('tr');

        for (let i = 1; i < tr.length; i++) {
            let text = tr[i].textContent || tr[i].innerText;
            tr[i].style.display = text.toUpperCase().indexOf(filter) > -1 ? "" : "none";
        }
    }
</script>
@endsection