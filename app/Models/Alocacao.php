<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alocacao extends Model
{
    use HasFactory;

    protected $fillable = ['bovino_id', 'fazenda_id', 'data_entrada'];

    public function bovino() { return $this->belongsTo(Bovino::class); }
    public function fazenda() { return $this->belongsTo(Fazenda::class); }
}
