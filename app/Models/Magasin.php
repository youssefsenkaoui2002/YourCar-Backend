<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magasin extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function voitures()
    {
        return $this->hasMany(Voiture::class);
    }
}
