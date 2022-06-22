<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesquisa extends Model
{
    protected $fillable = ['tema_pesquisa', 'horario', 'status',];
    use HasFactory;

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }

    public function resposta() {
        return $this->hasMany(Resposta::class);
    }
}
