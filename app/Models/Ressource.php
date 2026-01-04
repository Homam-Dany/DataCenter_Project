<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type', // Serveur, VM, Stockage, Réseau
        'category',
        'cpu',
        'ram',
        'storage_capacity',
        'storage_type',
        'bandwidth',
        'os',
        'location',
        'status', // disponible, maintenance, désactivée
        'manager_id' // ID du Responsable Technique
    ];

    /**
     * Relation : Une ressource est gérée par un responsable (User)
     */
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    /**
     * Relation : Une ressource peut avoir plusieurs réservations
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}