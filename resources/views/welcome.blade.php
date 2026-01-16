<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Center Manager | Accueil</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <style>
        /* Styles spécifiques pour la page de bienvenue */
        .welcome-body {
            background: linear-gradient(135deg, #2c3e50 0%, #000000 100%);
            color: white;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .welcome-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 3rem;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
            border: 1px solid rgba(255, 255, 255, 0.18);
            max-width: 500px;
            width: 90%;
        }

        .welcome-card h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #3498db;
        }

        .welcome-card p {
            margin-bottom: 2rem;
            color: #bdc3c7;
        }

        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .btn-welcome {
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
            display: inline-block;
        }

        .btn-primary-welcome {
            background-color: #3498db;
            color: white;
        }

        .btn-primary-welcome:hover {
            background-color: #2980b9;
        }

        .btn-outline-welcome {
            border: 2px solid #3498db;
            color: #3498db;
        }

        .btn-outline-welcome:hover {
            background-color: #3498db;
            color: white;
        }

        .guest-link {
            margin-top: 20px;
            display: block;
            color: #95a5a6;
            font-size: 0.9rem;
        }
    </style>
</head>
<body class="welcome-body">
    <div class="welcome-card">
        <h1>DC-Manager</h1>
        <p>Gestion intelligente et réservation de ressources pour votre Data Center.</p>

        <div class="btn-group">
    @if (Route::has('login'))
        @auth
            <a href="{{ url('/dashboard') }}" class="btn-welcome btn-primary-welcome">Accéder à mon Espace</a>
        @else
            <a href="{{ route('login') }}" class="btn-welcome btn-primary-welcome">Se connecter</a>
            
            @if (Route::has('register'))
                {{-- Point 1.2 de l'énoncé : Déposer une demande d’ouverture de compte --}}
                <a href="{{ route('register') }}" class="btn-welcome btn-outline-welcome">Demander l'ouverture d'un compte</a>
            @endif
        @endauth
    @endif
</div>

        <a href="{{ route('resources.index') }}" class="guest-link">
            Continuer en tant qu'invité (Consulter le catalogue)
        </a>
    </div>
</body>
</html>