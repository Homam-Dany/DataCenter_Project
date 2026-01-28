@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 50px; text-align: center; color: white; padding-bottom: 80px;">
    
    <div class="animate-fade-down" style="margin-bottom: 80px;">
        <h1 class="title-gradient" style="font-size: 3rem; margin-bottom: 15px;">À Propos du Data Center</h1>
        <p style="color: var(--text-muted); font-size: 1.1rem; margin-bottom: 50px; max-width: 800px; margin-left: auto; margin-right: auto;">
            Conditions générales d'accès et d'exploitation des ressources du Data Center IDAI.
        </p>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; text-align: left; padding: 0 20px;">
            <div class="team-card" style="border-top: 4px solid #10b981; padding: 30px;">
                <div style="display: flex; align-items: center; margin-bottom: 15px;">
                    <span style="background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 8px 14px; border-radius: 50%; font-weight: 800; margin-right: 15px;">01</span>
                    <h3 style="margin: 0;">Éligibilité</h3>
                </div>
                <p style="color: var(--text-muted); line-height: 1.6; font-size: 0.95rem;">
                    L'accès est réservé aux enseignants, chercheurs et doctorants disposant d'un compte actif validé. Le partage de compte est strictement interdit.
                </p>
            </div>

            <div class="team-card" style="border-top: 4px solid #818cf8; padding: 30px;">
                <div style="display: flex; align-items: center; margin-bottom: 15px;">
                    <span style="background: rgba(129, 140, 248, 0.1); color: #818cf8; padding: 8px 14px; border-radius: 50%; font-weight: 800; margin-right: 15px;">02</span>
                    <h3 style="margin: 0;">Réservations</h3>
                </div>
                <p style="color: var(--text-muted); line-height: 1.6; font-size: 0.95rem;">
                    Toute demande doit être justifiée. Les réservations sont limitées à 15 jours pour garantir un partage équitable des ressources entre les projets.
                </p>
            </div>

            <div class="team-card" style="border-top: 4px solid #ef4444; padding: 30px;">
                <div style="display: flex; align-items: center; margin-bottom: 15px;">
                    <span style="background: rgba(239, 68, 68, 0.1); color: #ef4444; padding: 8px 14px; border-radius: 50%; font-weight: 800; margin-right: 15px;">03</span>
                    <h3 style="margin: 0;">Interdictions</h3>
                </div>
                <p style="color: var(--text-muted); line-height: 1.6; font-size: 0.95rem;">
                    Le minage de cryptomonnaie, les tests d'intrusion non autorisés et le stockage de données illégales entraînent une exclusion immédiate.
                </p>
            </div>
        </div>
    </div>

    <hr style="border: 0; border-top: 1px solid rgba(255,255,255,0.05); margin: 60px 0; width: 80%; margin-left: auto; margin-right: auto;">

    <h2 class="section-title animate-fade-up">Administration</h2>
    <div style="display: flex; justify-content: center; margin-bottom: 60px;">
        <div class="team-card admin-border animate-card">
            <div class="image-wrapper">
                <img src="{{ asset('images/team/dany.jpg') }}" alt="Dany Homam" onerror="this.src='https://ui-avatars.com/api/?name=Dany+Homam&background=6366f1&color=fff'">
            </div>
            <h3>Dany Homam</h3>
            <p class="role">Administrateur Système</p>
            <a href="mailto:dany.homam@etu.uae.ac.ma" class="contact-btn admin-btn">📧 Contacter Dany</a>
        </div>
    </div>

    <h2 class="section-title animate-fade-up">Équipe Technique</h2>
    <div class="team-grid">
        <div class="team-card animate-card">
            <div class="image-wrapper">
                <img src="{{ asset('images/team/salim.png') }}" alt="El Bourmaki Salim" onerror="this.src='https://ui-avatars.com/api/?name=Salim+El+Bourmaki&background=818cf8&color=fff'">
            </div>
            <h3>El Bourmaki Salim</h3>
            <p class="role">Responsable Technique</p>
            <a href="mailto:elbourmaki.salim@etu.uae.ac.ma" class="contact-btn">📧 Contacter Salim</a>
        </div>

        <div class="team-card animate-card">
            <div class="image-wrapper">
                <img src="{{ asset('images/team/houssam.jpg') }}" alt="El Hajioui Houssam" onerror="this.src='https://ui-avatars.com/api/?name=Houssam+El+Hajioui&background=818cf8&color=fff'">
            </div>
            <h3>El Hajioui Houssam</h3>
            <p class="role">Responsable Technique</p>
            <a href="mailto:houssam.elhajioui@etu.uae.ac.ma" class="contact-btn">📧 Contacter Houssam</a>
        </div>

        <div class="team-card animate-card">
            <div class="image-wrapper">
                <img src="{{ asset('images/team/fatima.jpg') }}" alt="Farssi Fatima Zahra" onerror="this.src='https://ui-avatars.com/api/?name=Fatima+Zahra+Farssi&background=818cf8&color=fff'">
            </div>
            <h3>Farssi Fatima Zahra</h3>
            <p class="role">Responsable Technique</p>
            <a href="mailto:farssi.fatimazahra@etu.uae.ac.ma" class="contact-btn">📧 Contacter Fatima</a>
        </div>
    </div>
</div>

<style>
    @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-down { animation: fadeInDown 0.8s ease-out; }
    .animate-fade-up { animation: fadeInUp 0.8s ease-out; }
    .section-title { color: #818cf8; margin-bottom: 30px; text-transform: uppercase; font-size: 0.9rem; letter-spacing: 3px; opacity: 0.8; }
    .team-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 40px; padding: 20px; }
    .team-card { background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 24px; padding: 25px; transition: all 0.4s ease; }
    .team-card:hover { transform: translateY(-10px); background: rgba(255, 255, 255, 0.07); border-color: rgba(129, 140, 248, 0.5); }
    .admin-border { border: 1px solid rgba(99, 102, 241, 0.3); background: rgba(99, 102, 241, 0.05); max-width: 320px; }
    .image-wrapper { width: 100%; height: 320px; border-radius: 18px; overflow: hidden; margin-bottom: 20px; background: #0f172a; }
    .image-wrapper img { width: 100%; height: 100%; object-fit: cover; transition: 0.6s; }
    .team-card:hover img { transform: scale(1.1); }
    .role { color: #818cf8; font-weight: 700; font-size: 0.8rem; margin-bottom: 20px; text-transform: uppercase; }
    .contact-btn { display: block; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: white; text-decoration: none; padding: 12px; border-radius: 12px; font-weight: 600; transition: 0.3s; }
    .contact-btn:hover { background: #818cf8; }
</style>
@endsection