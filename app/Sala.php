<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $table = "sala";
    protected $primaryKey = 'sala_id';
    public $timestamps = false;

    
    public function asistentes() {
        return $this->hasMany(Asistente::class, 'sala_id');
    }
    
}
