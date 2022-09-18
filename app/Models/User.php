<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

use App\Models\Branch;
use App\Models\User;
use App\Models\Carrito;
use App\Models\Pedido;
use App\Models\Reserva;
use App\Models\Favoritos;
use App\Models\Rol;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cedula',
        'nombre',
        'apellidos',
        'fecha_nacimiento',
        'genero',
        'email',
        'rol_id',
        'noticias',
        'nombre_usuario',
        'password',
        'foto'
    ];
    public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }

    public function carrito(){
        return $this->hasMany(Carrito::class);
    }

    public function pedidos(){
        return $this->hasMany(Pedido::class);
    }

    public function reservas(){
        return $this->hasMany(Reserva::class);
    }

    public function favoritos(){
        return $this->hasMany(Favoritos::class);
    }

}
