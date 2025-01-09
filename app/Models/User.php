<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory ;

    protected $primaryKey = 'iduser'; // Nom de la clé primaire

    protected $fillable = [
        'UserName',
        'password',
        'type',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'user_iduser');
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'user_iduser');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'user_iduser');
    }
}

