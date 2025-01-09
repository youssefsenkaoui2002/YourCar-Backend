<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;
use App\Models\Magasin;

class Voiture extends Model
{
    use HasFactory;

    protected $table = 'visiteurs';
    protected $primaryKey = 'idvoitures';

    protected $fillable = [
        'marque',
        'modele',
        'year',
        'magasin_id',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'voitures_idvoitures');
    }
    public function magasins(){
        return $this->hasOne(Magasin::class, 'voitures_idvoitures');
    }
}

