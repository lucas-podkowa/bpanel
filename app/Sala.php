<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    
    protected $primaryKey = 'sala_id';
    protected $table = "sala";
    protected $fillable = ['meeting_id', 'meeting_name', 'participant_count','listener_count', 'voice_count','moodle_context', 'create_date'];
    public $timestamps = false;


    public function asistentes()
    {
        return $this->hasMany(Asistente::class, 'sala_id');
    }
}