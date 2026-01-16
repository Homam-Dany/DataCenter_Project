@extends('layouts.app')

@section('content')
<div class="main-content">
    {{-- En-tête avec votre nouveau dégradé Premium --}}
    <div class="header-section" style="text-align: center; margin-bottom: 50px;">
        <h1 class="stat-value" style="font-size: 3.5rem; letter-spacing: -2px; margin-bottom: 10px;">
            Règles d'<span style="color: white;">Utilisation</span>
        </h1>
        <p style="color: var(--text-muted); font-size: 1.1rem; max-width: 750px; margin: 0 auto;">
            Conditions générales d'accès et d'exploitation des ressources du Data Center IDAI.
        </p>
    </div>

    {{-- Grille des règles avec l'effet de verre (Glassmorphism) --}}
    <div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 25px;">
        
        {{-- Règle 01 : Éligibilité --}}
        <div class="card">
            <div style="display: flex; align-items: center; margin-bottom: 20px;">
                <span class="badge disponible" style="margin-right: 15px; padding: 8px 15px; font-size: 0.9rem;">01</span>
                <h3 style="color: white; font-size: 1.4rem; font-weight: 700; margin: 0;">Éligibilité</h3>
            </div>
            <p style="color: var(--text-muted); font-size: 1rem; line-height: 1.7;">
                L'accès est réservé aux enseignants, chercheurs et doctorants disposant d'un compte actif validé. Le partage de compte est strictement interdit.
            </p>
        </div>

        {{-- Règle 02 : Réservations --}}
        <div class="card">
            <div style="display: flex; align-items: center; margin-bottom: 20px;">
                <span class="badge disponible" style="margin-right: 15px; padding: 8px 15px; font-size: 0.9rem;">02</span>
                <h3 style="color: white; font-size: 1.4rem; font-weight: 700; margin: 0;">Réservations</h3>
            </div>
            <p style="color: var(--text-muted); font-size: 1rem; line-height: 1.7;">
                Toute demande doit être justifiée. Les réservations sont limitées à 15 jours pour garantir un partage équitable des ressources entre les projets.
            </p>
        </div>

        {{-- Règle 03 : Interdictions (Accentuée en Rouge) --}}
        <div class="card" style="border-top: 4px solid var(--accent-red);">
            <div style="display: flex; align-items: center; margin-bottom: 20px;">
                <span class="badge maintenance" style="margin-right: 15px; padding: 8px 15px; font-size: 0.9rem; border-color: var(--accent-red); color: var(--accent-red);">03</span>
                <h3 style="color: white; font-size: 1.4rem; font-weight: 700; margin: 0;">Interdictions</h3>
            </div>
            <p style="color: var(--text-muted); font-size: 1rem; line-height: 1.7;">
                Le minage de cryptomonnaie, les tests d'intrusion non autorisés et le stockage de données illégales entraînent une exclusion immédiate.
            </p>
        </div>
    </div>

    {{-- SECTION ASSISTANCE & CONTACT (Fusionnée et stylisée) --}}
    <div class="card" style="margin-top: 40px; background: linear-gradient(145deg, rgba(129, 140, 248, 0.05) 0%, var(--card-bg) 100%);">
        <h3 class="title-gradient" style="font-size: 1.8rem; margin-bottom: 25px; -webkit-text-fill-color: initial; color: white;">Assistance & Maintenance</h3>
        
        <p style="color: var(--text-muted); line-height: 1.8; margin-bottom: 30px;">
            En cas d'incident technique, signalez-le via votre espace. Les responsables peuvent suspendre l'accès pour maintenance urgente sans préavis.
        </p>

        <div style="display: flex; flex-wrap: wrap; gap: 40px; align-items: center; background: rgba(0,0,0,0.2); padding: 25px; border-radius: 20px;">
            {{-- Icone LED stylisée --}}
            <div style="background: var(--accent-cyan); color: white; width: 60px; height: 60px; border-radius: 15px; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; box-shadow: 0 0 20px var(--neon-glow);">
                📧
            </div>

            <div style="flex: 1; min-width: 250px;">
                <p style="color: var(--accent-cyan); font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 5px;">Support Technique IDAI</p>
                <p style="font-size: 1.3rem; font-weight: 700; color: white; margin-bottom: 5px;">Dany Homam</p>
                <a href="mailto:dany.homam@etu.uae.ac.ma" style="color: var(--accent-cyan); font-size: 1.1rem; text-decoration: none; font-weight: 600;">dany.homam@etu.uae.ac.ma</a>
                <p style="color: var(--text-muted); font-size: 0.85rem; margin-top: 5px;">Disponibilité : Lun - Ven (09:00 - 18:00)</p>
            </div>

            @guest
            <div style="border-left: 1px solid var(--glass-border); padding-left: 30px;">
                <p style="color: white; font-weight: 600; margin-bottom: 15px;">Pas encore de compte ?</p>
                <a href="{{ route('register') }}" class="btn btn-primary">Déposer une demande</a>
            </div>
            @endguest
        </div>
    </div>
</div>
@endsection