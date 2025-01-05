<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name',
        'lName',
        'adress',
        'phone',
        'CIN',
        'NumP',
        'city',
        'DateBirth',
        'email',
    ];
    
}
