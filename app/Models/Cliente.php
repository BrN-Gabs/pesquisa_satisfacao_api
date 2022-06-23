<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nome', 'email', 'senha', 'telefone',
        'cpf', 'cep', 'cidade', 'estado', 'endereco',
        'bairro', 'numero', 'horario', 'perfils_id'
    ];
    use HasFactory;
    
    public $timestamps = false;

    public function perfil() {
        return $this->belongsTo(Perfil::class);
    }

    public function pesquisa() {
        return $this->hasMany(Pesquisa::class);
    }
}
