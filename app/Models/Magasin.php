<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Magasin extends Model
{
    protected $fillable = ['name', 'location', 'phone'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function voitures()
    {
        return $this->hasMany(Voiture::class);
    }
}
