<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'iduser';

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

    protected function type(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["user", "admin", "manager",'supermanager','autre'][$value],
        );
    }
}

