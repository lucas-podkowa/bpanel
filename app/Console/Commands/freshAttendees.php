<?php

namespace App\Console\Commands;

use App\Asistente;
use App\Sala;
use Illuminate\Console\Command;

class freshAttendees extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'freshAttendees';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Revisa una URL y actualiza los Asistentes de las salas existentes en la BD';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $url = 'https://bbb.fio.unam.edu.ar/bigbluebutton/api/getMeetings?checksum=7af8345722fb7dcdd1baa3a26342c5092842820f';
        $xml = simplexml_load_file($url);

        $nodes = $xml->children();
        $asistentes = array();

        //por cada sala del xml debo revisar si la sala ya existe en la BD,
        //si la sala existe, debo mirar sus participantes almacenados donde la tabla asistentes tendra la sala_id de la tabla sala
        //si no existe ese asistente, se le da de alta

        foreach ($nodes->meetings as $meets) {
            foreach ($meets as $m) {
                $meeting_id = $m->meetingID;
                $existeSala = Sala::where('meeting_id', $meeting_id)->first();

                if (!empty($existeSala)) {
                    $sala_id = $existeSala->sala_id;

                    foreach ($m->attendees->attendee as $p) {
                        $existeAsistente = Asistente::where('sala_id', $sala_id)
                            ->where('user_id', $p->userID)
                            ->first();
                        if (!$existeAsistente) {
                            $full_name = $p->fullName;
                            $role = $p->role;
                            $user_id = $p->userID;
                            $a = compact('user_id', 'sala_id', 'full_name', 'role');
                            
                            $na = Asistente::firstOrCreate($a);
                            $na->save();
                        }
                    }
                    $existeSala->participant_count = Asistente::where('sala_id', $sala_id)->count();
                    $existeSala->save();
                }
            }
        }
    }
}
