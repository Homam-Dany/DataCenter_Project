<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'resource_id',
        'start_date',
        'end_date',
        'status', // en_attente, Approuvée, Refusée, Active, Terminée
        'justification',
        'rejection_reason'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function resource() { return $this->belongsTo(Resource::class); }
    public function user() { return $this->belongsTo(User::class); }

    /**
     * LOGIQUE PROFESSIONNELLE : Vérification des chevauchements (Overlapping)
     * Cette fonction empêche de réserver une ressource déjà prise.
     */
    public function scopeOverlapping($query, $resourceId, $startDate, $endDate)
    {
        return $query->where('resource_id', $resourceId)
                     ->whereIn('status', ['Approuvée', 'en_attente', 'Active'])
                     ->where(function ($q) use ($startDate, $endDate) {
                         $q->where(function ($inner) use ($startDate, $endDate) {
                             $inner->where('start_date', '<', $endDate)
                                   ->where('end_date', '>', $startDate);
                         });
                     });
    }
}