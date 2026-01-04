<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    
                    <x-nav-link :href="route('resources.index')" :active="request()->routeIs('resources.index')">
                        {{ __('Catalogue') }}
                    </x-nav-link>

                    {{-- Lien visible uniquement pour les utilisateurs internes --}}
                    @if(auth()->user()->role === 'user')
                        <x-nav-link :href="route('reservations.index')" :active="request()->routeIs('reservations.index')">
                            {{ __('Mes Réservations') }}
                        </x-nav-link>
                    @endif

                    {{-- NOUVEAU : Liens pour le Responsable Technique --}}
                    @if(auth()->user()->role === 'responsable')
                        <x-nav-link :href="route('resources.manager')" :active="request()->routeIs('resources.manager')">
                            {{ __('Gérer mes Ressources') }}
                        </x-nav-link>
                        <x-nav-link :href="route('reservations.manager')" :active="request()->routeIs('reservations.manager')">
                            {{ __('Demandes à valider') }}
                        </x-nav-link>
                    @endif

                    {{-- NOUVEAU : Liens pour l'Administrateur --}}
                    @if(auth()->user()->role === 'admin')
                        <x-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')">
                            {{ __('Utilisateurs') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.logs')" :active="request()->routeIs('admin.logs')">
                            {{ __('Logs Système') }}
                        </x-nav-link>
                    @endif

                    <x-nav-link :href="route('notifications.index')" :active="request()->routeIs('notifications.index')">
                        {{ __('Notifications') }}
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="ml-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </x-nav-link>

                    <x-nav-link :href="route('resources.rules')" :active="request()->routeIs('resources.rules')">
                        {{ __('Règles') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            {{-- Affichage du rôle mis à jour --}}
                            <div>{{ Auth::user()->name }} (<span class="capitalize">{{ Auth::user()->role }}</span>)</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profil') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Déconnexion') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            </div>
    </div>
</nav>