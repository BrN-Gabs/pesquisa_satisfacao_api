<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{
    protected $fillable = ['resposta', 'pesquisa_id', 'nome'];
    use HasFactory;

    public function pesquisa() {
        return $this->belongsTo(Pesquisa::class);
    }
}
