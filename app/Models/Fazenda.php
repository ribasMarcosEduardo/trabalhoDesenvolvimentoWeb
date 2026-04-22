<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fazenda extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'localizacao'];


    public function bovinos()
    {
        return $this->hasManyThrough(Bovino::class, Alocacao::class, 'fazenda_id', 'id', 'id', 'bovino_id');
    }

}
