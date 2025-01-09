<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\Voiture;

class Magasin extends Model
{
    use HasFactory;

    protected $table = 'magasin';
    protected $primaryKey = 'idmagasin';
    protected $fillable = [
        'nom',
        'ville',
        'telephone',
        'adresse',
        'status'
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'magasin_idmagasin');
    }

    public function voitures(){
        return $this->hasMany(Voiture::class, 'magasin_id');
    }
}
