<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'documents';
    protected $primaryKey = 'iddocument';
    protected $fillable = ['reservation_idreservation', 'reservation_employee_idemployee', 'reservation_user_iduser'];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_idreservation');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'reservation_employee_idemployee');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'reservation_user_iduser');
    }
}

