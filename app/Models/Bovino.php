<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bovino extends Model
{
    use HasFactory;

    protected $fillable = ['raca', 'peso', 'preco', 'idade', 'imagem'];

    public function alocacoes() {
    return $this->hasMany(Alocacao::class);
}

public function fazendaAtual()
{
    return $this->hasOneThrough(
        Fazenda::class, 
        Alocacao::class, 
        'bovino_id', 
        'id',        
        'id',       
        'fazenda_id' // F
    )->latestOfMany();
}
}


