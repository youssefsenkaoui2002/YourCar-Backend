<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'iduser';
    protected $fillable = ['name', 'email', 'password'];

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

