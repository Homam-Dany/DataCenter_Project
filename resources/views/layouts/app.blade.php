<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataCenter Manager</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header class="main-header">
        <nav class="navbar-custom">
            <div class="brand">DC-Manager</div>
            <ul class="nav-links">
    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li><a href="{{ route('resources.index') }}">Catalogue</a></li>

    @auth
        {{-- Section réservée aux utilisateurs connectés --}}
        @if(auth()->user()->role === 'user')
            <li><a href="{{ route('reservations.index') }}">Mes Réservations</a></li>
        @endif

        @if(auth()->user()->role === 'responsable' || auth()->user()->role === 'admin')
            <li><a href="{{ route('resources.manager') }}">Ma Gestion</a></li>
        @endif

        {{-- Ligne 22 corrigée : Les notifications ne s'affichent que si on est connecté --}}
        <li>
            <a href="{{ route('notifications.index') }}">
                Notifications ({{ auth()->user()->unreadNotifications->count() }})
            </a>
        </li>
    @endauth
</ul>
            <div class="user-info">
            @auth
                {{-- Ces éléments ne s'affichent QUE si l'utilisateur est connecté --}}
                <span>{{ auth()->user()->name }}</span>
                
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Déconnexion</button>
                </form>
            @else
                {{-- Optionnel : Afficher un bouton de connexion pour les invités --}}
                <a href="{{ route('login') }}" class="btn btn-primary">Connexion</a>
            @endauth
        </div>
        </nav>
    </header>

    <main class="main-content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @yield('content')
    </main>

    <footer class="main-footer">
        <p>&copy; {{ date('Y') }} - Gestion de Ressources Data Center</p>
    </footer>
</body>
</html>