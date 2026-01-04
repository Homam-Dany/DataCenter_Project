<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Reservation;

class ReservationStatusNotification extends Notification
{
    use Queueable;

    protected $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * On définit que la notification sera stockée en base de données
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Contenu de la notification stocké en JSON
     */
    public function toArray($notifiable)
    {
        return [
            'reservation_id' => $this->reservation->id,
            'resource_name' => $this->reservation->resource->name,
            'status' => $this->reservation->status,
            'message' => "Le statut de votre réservation pour {$this->reservation->resource->name} est désormais : {$this->reservation->status}.",
            'rejection_reason' => $this->reservation->rejection_reason,
        ];
    }
}