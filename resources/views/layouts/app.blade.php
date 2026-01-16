<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataCenter Manager</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
</head>
<body>
    <header class="main-header">
        <nav class="navbar-custom">
            <div class="brand" style="font-weight: 900; font-size: 1.5rem; letter-spacing: -1px;">
                DC-<span style="color: var(--accent-cyan);">Manager</span>
            </div>

            <ul class="nav-links">
                {{-- 1. DASHBOARD : S'allume pour les deux types de dashboard --}}
                <li>
                    <a href="{{ auth()->user() && in_array(auth()->user()->role, ['admin', 'responsable']) ? route('admin.dashboard') : route('dashboard') }}" 
                       class="{{ request()->routeIs('dashboard') || request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a>
                </li>

                {{-- 2. CATALOGUE --}}
                <li>
                    <a href="{{ route('resources.index') }}" 
                       class="{{ request()->routeIs('resources.index') ? 'active' : '' }}">
                        Catalogue
                    </a>
                </li>

                @auth
                    {{-- 3. ACTIONS UTILISATEUR --}}
                    @if(auth()->user()->role === 'user')
                        <li>
                            <a href="{{ route('reservations.index') }}" 
                               class="{{ request()->routeIs('reservations.index') ? 'active' : '' }}">
                                Mes Réservations
                            </a>
                        </li>
                    @endif

                    {{-- 4. GESTION (RESPONSABLE/ADMIN) --}}
                    @if(auth()->user()->role === 'responsable' || auth()->user()->role === 'admin')
                        <li>
                            <a href="{{ route('resources.manager') }}" 
                               class="{{ request()->routeIs('resources.manager') ? 'active' : '' }}">
                                Ma Gestion
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('incidents.manager') }}" 
                               class="{{ request()->routeIs('incidents.manager') ? 'active' : '' }}">
                                Incidents
                            </a>
                        </li>
                    @endif

                    {{-- 5. ADMIN TOOLS --}}
                    @if(auth()->user()->role === 'admin')
                        <li>
                            <a href="{{ route('admin.users') }}" 
                               class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">
                                Utilisateurs
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.logs') }}" 
                               class="{{ request()->routeIs('admin.logs') ? 'active' : '' }}">
                                Logs
                            </a>
                        </li>
                    @endif

                    {{-- 6. NOTIFICATIONS : S'allume aussi --}}
                    <li>
                        <a href="{{ route('notifications.index') }}" 
                           class="{{ request()->routeIs('notifications.index') ? 'active' : '' }}">
                            Notifications 
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <span style="background: var(--accent-red); padding: 2px 8px; border-radius: 10px; font-size: 0.8rem; margin-left: 5px;">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </a>
                    </li>
                @endauth

                {{-- 7. À PROPOS (DÉPLACÉ À LA FIN ET S'ALLUME SUR SA PAGE) --}}
                <li>
                    <a href="{{ route('about') }}" 
                       class="{{ request()->routeIs('about') ? 'active' : '' }}">
                        À Propos
                    </a>
                </li>
            </ul>

            <div class="user-info">
                @auth
                    <span style="margin-right: 15px; font-weight: 600; color: var(--text-muted);">
                        {{ auth()->user()->name }} <small style="color: var(--accent-cyan);">({{ auth()->user()->role }})</small>
                    </span>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="logout-btn">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Connexion</a>
                @endauth
            </div>
        </nav>
    </header>

    <main class="main-content">
        @if(session('success'))
            <div class="alert alert-success" style="background: rgba(16, 185, 129, 0.2); border: 1px solid var(--accent-green); color: var(--accent-green); padding: 15px; border-radius: 12px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </main>

    <footer class="main-footer" style="margin-top: 50px; border-top: 1px solid var(--glass-border); padding: 20px; text-align: center; color: var(--text-muted);">
        <p>&copy; {{ date('Y') }} - Gestion de Ressources Data Center IDAI</p>
    </footer>
</body>
</html>