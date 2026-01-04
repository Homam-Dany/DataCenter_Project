<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Reservation; // Importation du modèle indispensable

class NewReservationNotification extends Notification
{
    use Queueable;

    // 1. Déclaration de la propriété publique pour qu'elle soit accessible partout dans la classe
    public $reservation;

    /**
     * Create a new notification instance.
     * On injecte l'objet Reservation ici depuis le contrôleur
     */
    public function __construct(Reservation $reservation)
    {
        // 2. Assignation de l'objet à la propriété de la classe
        $this->reservation = $reservation;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['database']; // Stockage en base de données pour la navbar et la page notifications
    }

    /**
     * Get the array representation of the notification.
     * C'est ici que sont générées les données lues par votre vue
     */
    public function toArray($notifiable)
    {
        return [
            // 3. Maintenant ces lignes fonctionneront sans erreur
            'reservation_id' => $this->reservation->id,
            'message' => 'Nouvelle demande de réservation pour ' . $this->reservation->resource->name,
            'user_name' => $this->reservation->user->name,
        ];
    }
}