<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistente extends Model
{
    use HasFactory;

    protected $table = 'asistente';
    public $timestamps = false;

    public function sala()    {
        return $this->belongsTo(Sala::class);
    }

}
