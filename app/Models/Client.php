<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Reservation;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';
    protected $primaryKey = 'idclient';
    protected $fillable = [
        'user_iduser',
        'nom',
        'prenom',
        'adresse',
        'telephone',
        'email',
        'date_naissance',
        'ville',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_iduser');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'user_iduser');
    }

}

