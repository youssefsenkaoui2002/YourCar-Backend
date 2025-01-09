<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
