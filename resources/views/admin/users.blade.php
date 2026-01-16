@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 30px;">
    {{-- En-tête --}}
    <div class="header-section" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <div>
            <h1 class="logo-text">Gestion des <span>Utilisateurs</span></h1>
            <p class="subtitle">Validez les nouveaux comptes et gérez les accès au Data Center.</p>
        </div>
        <div style="text-align: right;">
            <span class="badge" style="background: var(--accent); color: white; padding: 10px 20px; border-radius: 50px;">
                {{ count($users) }} membres au total
            </span>
        </div>
    </div>

    {{-- SECTION 1 : DEMANDES D'OUVERTURE DE COMPTE (EN ATTENTE) --}}
    @php $pendingUsers = $users->where('role', 'guest')->where('is_active', false); @endphp
    
    <div style="margin-bottom: 40px;">
        <h2 style="color: #f59e0b; font-size: 1.2rem; display: flex; align-items: center; gap: 10px; margin-bottom: 15px;">
            <span style="background: #f59e0b; width: 12px; height: 12px; border-radius: 50%;"></span>
            ⏳ Demandes d'ouverture de compte ({{ count($pendingUsers) }})
        </h2>

        <div class="card" style="background: rgba(245, 158, 11, 0.05); border: 1px solid rgba(245, 158, 11, 0.2); border-radius: 12px; overflow: hidden;">
            @if(count($pendingUsers) > 0)
                <table style="width: 100%; border-collapse: collapse;">
                    <thead style="background: rgba(245, 158, 11, 0.1);">
                        <tr>
                            <th style="padding: 15px; text-align: left;">Candidat</th>
                            <th style="padding: 15px; text-align: left;">Attribuer un Rôle & Valider</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingUsers as $guest)
                        <tr style="border-bottom: 1px solid rgba(245, 158, 11, 0.1);">
                            <td style="padding: 15px;">
                                <strong style="color: white;">{{ $guest->name }}</strong><br>
                                <small style="color: var(--text-muted);">{{ $guest->email }}</small>
                            </td>
                            <td style="padding: 15px;">
                                <form action="{{ route('admin.users.update', $guest) }}" method="POST" style="display: flex; gap: 15px; align-items: center;">
                                    @csrf @method('PATCH')
                                    <select name="role" required style="background: #0f172a; color: white; border: 1px solid #334155; padding: 8px; border-radius: 8px; flex: 1;">
                                        <option value="" disabled selected>Choisir le rôle final...</option>
                                        <option value="user">Utilisateur Interne</option>
                                        <option value="responsable">Responsable Technique</option>
                                        <option value="admin">Administrateur</option>
                                    </select>
                                    <input type="hidden" name="is_active" value="1">
                                    <button type="submit" class="btn btn-primary" style="background: #f59e0b; border: none;">
                                        ✅ Accepter & Activer
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="padding: 20px; color: var(--text-muted); text-align: center;">Aucune demande en attente pour le moment.</p>
            @endif
        </div>
    </div>

    {{-- SECTION 2 : UTILISATEURS ACTIFS & GESTION GÉNÉRALE --}}
    <h2 style="color: white; font-size: 1.2rem; margin-bottom: 15px;">👥 Gestion des accès existants</h2>
    <div class="card" style="background: var(--card-bg); padding: 0; border-radius: 12px; box-shadow: var(--shadow); overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="text-align: left; background: rgba(255,255,255,0.02);">
                    <th style="padding: 15px; border-bottom: 1px solid var(--glass-border);">Utilisateur</th>
                    <th style="padding: 15px; border-bottom: 1px solid var(--glass-border);">Rôle Actuel</th>
                    <th style="padding: 15px; border-bottom: 1px solid var(--glass-border);">Statut</th>
                    <th style="padding: 15px; border-bottom: 1px solid var(--glass-border); text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users->where('role', '!=', 'guest') as $user)
                <tr style="border-bottom: 1px solid var(--glass-border);">
                    <td style="padding: 15px;">
                        <strong style="color: white;">{{ $user->name }}</strong><br>
                        <small style="color: var(--text-muted);">{{ $user->email }}</small>
                    </td>
                    <td style="padding: 15px;">
                        <form action="{{ route('admin.users.update', $user) }}" method="POST" style="display: flex; gap: 10px;">
                            @csrf @method('PATCH')
                            <select name="role" style="background: transparent; color: #818cf8; border: 1px solid #334155; padding: 5px; border-radius: 6px;">
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Utilisateur Interne</option>
                                <option value="responsable" {{ $user->role == 'responsable' ? 'selected' : '' }}>Responsable Tech</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrateur</option>
                            </select>
                            <button type="submit" class="btn" style="padding: 5px; font-size: 0.7rem; color: var(--text-muted);">Maj</button>
                        </form>
                    </td>
                    <td style="padding: 15px;">
                        <span class="badge {{ $user->is_active ? 'badge-approved' : 'badge-rejected' }}" style="padding: 5px 12px;">
                            {{ $user->is_active ? 'Actif' : 'Désactivé' }}
                        </span>
                    </td>
                    <td style="padding: 15px; text-align: center;">
                        <form action="{{ route('admin.users.update', $user) }}" method="POST">
                            @csrf @method('PATCH')
                            <input type="hidden" name="is_active" value="{{ $user->is_active ? 0 : 1 }}">
                            <button class="btn" style="font-size: 0.75rem; color: {{ $user->is_active ? '#f43f5e' : '#10b981' }}; background: rgba(255,255,255,0.05); padding: 8px 15px; border-radius: 8px;">
                                {{ $user->is_active ? 'Révoquer l\'accès' : 'Réactiver' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection