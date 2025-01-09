<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;
use App\Models\Employee;
use App\Models\Client;


class Document extends Model
{
    use HasFactory;

    protected $table = 'documents';
    protected $primaryKey = 'iddocument';
    protected $fillable = [
        'reservation_idreservation',
        'reservation_employee_idemployee',
        'reservation_user_iduser',
        'type_document',
        'chemin_fichier',
        'nom_fichier',
        'date_emission',
        'description'
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_idreservation');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'reservation_employee_idemployee');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'reservation_user_iduser');
    }
}

