{{-- Style Ultra Class injecté pour la Navbar --}}
<nav x-data="{ open: false }" style="background: rgba(1, 4, 9, 0.8); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border-bottom: 1px solid rgba(255, 255, 255, 0.08);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                {{-- LOGO : Redirection intelligente selon la connexion --}}
                <div class="shrink-0 flex items-center">
                    <a href="{{ Auth::check() ? (Auth::user()->isAdmin() ? route('admin.dashboard') : route('dashboard')) : url('/') }}" style="text-decoration: none;">
                        <span style="color: white; font-weight: 900; font-size: 1.5rem; letter-spacing: -1px;">DC-<span style="color: #818cf8;">Manager</span></span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    {{-- LIENS PUBLICS (Visibles par l'Invité et les autres) --}}
                    <x-nav-link :href="route('resources.index')" :active="request()->routeIs('resources.index')" style="color: var(--text-muted); font-weight: 700;">
                        {{ __('Catalogue') }}
                    </x-nav-link>

                    <x-nav-link :href="route('resources.rules')" :active="request()->routeIs('resources.rules')" style="color: #818cf8; font-weight: 800; border-bottom: 2px solid #818cf8;">
                        {{ __('Règles') }}
                    </x-nav-link>

                    {{-- LIENS PRIVÉS (Uniquement si connecté) --}}
                    @auth
                        <x-nav-link :href="auth()->user()->isAdmin() ? route('admin.dashboard') : route('dashboard')" 
                                    :active="request()->routeIs('dashboard') || request()->routeIs('admin.dashboard')"
                                    style="color: var(--text-muted); font-weight: 700;">
                            {{ auth()->user()->isAdmin() ? __('Statistiques') : __('Dashboard') }}
                        </x-nav-link>

                        {{-- Utilisateur Interne --}}
                        @if(auth()->user()->isUser())
                            <x-nav-link :href="route('reservations.index')" :active="request()->routeIs('reservations.index')" style="color: var(--text-muted); font-weight: 700;">
                                {{ __('Mes Réservations') }}
                            </x-nav-link>
                        @endif

                        {{-- Responsable & Admin --}}
                        @if(auth()->user()->isAdmin() || auth()->user()->isResponsable())
                            <x-nav-link :href="route('resources.manager')" :active="request()->routeIs('resources.manager')" style="color: var(--text-muted); font-weight: 700;">
                                {{ __('Ma Gestion') }}
                            </x-nav-link>
                            <x-nav-link :href="route('reservations.manager')" :active="request()->routeIs('reservations.manager')" style="color: var(--text-muted); font-weight: 700;">
                                {{ __('Demandes') }}
                            </x-nav-link>
                        @endif

                        {{-- Admin Uniquement --}}
                        @if(auth()->user()->isAdmin())
                            <x-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')" style="color: var(--text-muted); font-weight: 700;">
                                {{ __('Utilisateurs') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.logs')" :active="request()->routeIs('admin.logs')" style="color: var(--text-muted); font-weight: 700;">
                                {{ __('Logs') }}
                            </x-nav-link>
                        @endif

                        <x-nav-link :href="route('notifications.index')" :active="request()->routeIs('notifications.index')" style="color: var(--text-muted); font-weight: 700;">
                            {{ __('Notifications') }}
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <span style="margin-left: 8px; background: #f43f5e; color: white; padding: 2px 8px; border-radius: 10px; font-size: 10px; box-shadow: 0 0 10px rgba(244, 63, 94, 0.5);">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </x-nav-link>
                    @endauth
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    {{-- Menu Profil si connecté --}}
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: white; padding: 8px 16px; border-radius: 10px; display: flex; align-items: center; cursor: pointer; transition: 0.3s;">
                                <div style="font-weight: 600;">{{ Auth::user()->name }} <span style="color: #818cf8; font-size: 0.8rem; margin-left: 5px;">({{ Auth::user()->role }})</span></div>
                                <svg class="ml-2 h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/></svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div style="background: #0f172a; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 5px;">
                                <x-dropdown-link :href="route('profile.edit')" style="color: white; border-radius: 5px;">{{ __('Mon Profil') }}</x-dropdown-link>
                                
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" 
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        style="color: #f43f5e; font-weight: 700; border-top: 1px solid rgba(255,255,255,0.05);">
                                        {{ __('Déconnexion') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                @else
                    {{-- Boutons de connexion pour l'Invité --}}
                    <div class="space-x-4">
                        <a href="{{ route('login') }}" style="color: white; font-weight: 700; text-decoration: none;">Connexion</a>
                        <a href="{{ route('register') }}" style="background: #818cf8; color: white; padding: 8px 16px; border-radius: 10px; font-weight: 700; text-decoration: none;">Demander un compte</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>