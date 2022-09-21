<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Libro;

class Pedido extends Model
{
    use HasFactory;
    protected $fillable = [
        'usuario_id',
        'libro_id',
        'cantidad',
        'precio',
        'fecha',
        'direccion',
        'ciudad',
    ];
    public $timestamps = false;

        
    public function libro(){
        return $this->belongsTo(Libro::class);
    }
    public function usuario(){
        return $this->belongsTo(User::class);
    }
}
