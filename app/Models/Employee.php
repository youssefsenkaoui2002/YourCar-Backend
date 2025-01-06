<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';
    protected $primaryKey = 'idemployee';
    protected $fillable = ['user_iduser', 'magasin_idmagasin'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_iduser');
    }

    public function magasin()
    {
        return $this->belongsTo(Magasin::class, 'magasin_idmagasin');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'employee_idemployee');
    }
}

