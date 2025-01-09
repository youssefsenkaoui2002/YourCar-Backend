<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Document;
use App\Models\Client;
use App\Models\Voiture;
use App\Models\Employee;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';
    protected $primaryKey = 'idreservation';
    protected $fillable = [
        'employee_idemployee',
        'user_iduser',
        'voitures_idvoitures',
        'date_debut',
        'date_fin',
        'montant_total',
        'status',
        'notes',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_idemployee');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'user_iduser');
    }

    public function voiture()
    {
        return $this->belongsTo(Voiture::class, 'voitures_idvoitures');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'reservation_idreservation');
    }
}
