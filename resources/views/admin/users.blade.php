@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 30px;">
    <div class="header-section" style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1 class="logo-text">Gestion des <span>Utilisateurs</span></h1>
            <p class="subtitle">Validez les nouveaux comptes et gérez les accès au Data Center.</p>
        </div>
        <span class="badge" style="background: var(--accent); color: white; padding: 10px 20px; border-radius: 50px;">
            {{ count($users) }} membres
        </span>
    </div>

    <div class="card" style="background: white; padding: 20px; border-radius: 12px; margin-top: 20px; box-shadow: var(--shadow); overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="text-align: left; background: var(--light);">
                    <th style="padding: 15px; border-bottom: 2px solid #e2e8f0;">Utilisateur</th>
                    <th style="padding: 15px; border-bottom: 2px solid #e2e8f0;">Rôle & Permissions</th>
                    <th style="padding: 15px; border-bottom: 2px solid #e2e8f0;">État du compte</th>
                    <th style="padding: 15px; border-bottom: 2px solid #e2e8f0; text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr style="border-bottom: 1px solid #edf2f7;">
                    <td style="padding: 15px;">
                        <strong>{{ $user->name }}</strong><br>
                        <small style="color: #a0aec0;">{{ $user->email }}</small>
                    </td>
                    <td style="padding: 15px;">
                        <form action="{{ route('admin.users.update', $user) }}" method="POST" style="display: flex; gap: 10px;">
                            @csrf @method('PATCH')
                            <select name="role" class="input" style="padding: 5px; border-radius: 6px; border: 1px solid #e2e8f0;">
                                <option value="guest" {{ $user->role == 'guest' ? 'selected' : '' }}>Invité (Attente)</option>
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Utilisateur Interne</option>
                                <option value="responsable" {{ $user->role == 'responsable' ? 'selected' : '' }}>Responsable Tech</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrateur</option>
                            </select>
                            <button type="submit" class="btn btn-primary" style="padding: 5px 12px; font-size: 0.75rem;">Changer</button>
                        </form>
                    </td>
                    <td style="padding: 15px;">
                        <span class="badge {{ $user->is_active ? 'disponible' : 'maintenance' }}">
                            {{ $user->is_active ? 'Actif' : 'Désactivé' }}
                        </span>
                    </td>
                    <td style="padding: 15px; text-align: center;">
                        {{-- Bouton d'activation/désactivation --}}
                        <form action="{{ route('admin.users.update', $user) }}" method="POST">
                            @csrf @method('PATCH')
                            <input type="hidden" name="is_active" value="{{ $user->is_active ? 0 : 1 }}">
                            <button class="btn {{ $user->is_active ? 'btn-logout' : 'btn-primary' }}" style="font-size: 0.75rem; width: 100px;">
                                {{ $user->is_active ? 'Désactiver' : 'Activer' }}
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