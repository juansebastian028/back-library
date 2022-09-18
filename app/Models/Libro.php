<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Favoritos;
use App\Models\Carrito;
use App\Models\Pedidos;
use App\Models\Reservas;

class Libro extends Model
{
    use HasFactory;
    protected $fillable = [
        'titulo',
        'autor',
        'anio',
        'genero',
        'paginas',
        'editorial',
        'ISSN',
        'idioma',
        'precio',
        'fecha_publicacion',
        'cantidad',
        'estado'
    ];
    public $timestamps = false;

    
    public function carrito(){
        return $this->hasMany(Carrito::class);
    }

    public function favoritos(){
        return $this->hasMany(Favoritos::class);
    }

    public function pedidos(){
        return $this->hasMany(Pedidos::class);
    }

    public function reservas(){
        return $this->hasMany(Pedidos::class);
    }
}
