<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistente extends Model
{
    use HasFactory;

    protected $table = 'asistente';
    protected $primaryKey = 'asistente_id';
    public $timestamps = false;    
    protected $fillable = ['user_id', 'sala_id', 'full_name','role'];

    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }
}
