<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Libro;

class Favoritos extends Model
{
    use HasFactory;
    protected $fillable = [
        // 'usuario_id',
        // 'libro_id'
    ];

    
    public function libros(){
        return $this->belongsTo(Libro::class);
    }

    public function usuarios(){
        return $this->belongsTo(User::class);
    }

    public $timestamps = false;
}
