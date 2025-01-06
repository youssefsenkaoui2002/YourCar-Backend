<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voiture extends Model
{
    use HasFactory;

    protected $table = 'voitures';
    protected $primaryKey = 'idvoitures';
    protected $fillable = ['nom', 'email'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'voitures_idvoitures');
    }
}

