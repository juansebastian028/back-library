<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Libro;

class Carrito extends Model
{
    use HasFactory;
    protected $fillable = [
        'libro_id',
        'usuario_id',
        'cantidad'
    ];

    public function libros(){
        return $this->hasMany(Libro::class);
    }

    public function usuarios(){
        return $this->hasMany(User::class);
    }
    public $timestamps = false;
}
