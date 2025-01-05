<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voiture extends Model
{
    use HasFactory;
    protected $fillable = [
        'marque',
        'modele',
        'year',
        'reservation_id',
        'magasin_id',
    ];

    
    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'reservation_voiture');
    }
    public function magasin()
    {
        return $this->belongsTo(Magasin::class);
    }
}
