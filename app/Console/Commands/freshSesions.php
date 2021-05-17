<?php

namespace App\Console\Commands;

use App\Sala;
use Illuminate\Console\Command;

class freshSesions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'freshSesion';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Revisa una URL y actualiza las salas en la BD';

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
        $filas = $todos = array();

        foreach ($nodes->meetings as $meets) {
            foreach ($meets as $m) {;
                $meeting_id = $m->meetingID;

                $existencia = Sala::where('meeting_id', $meeting_id)->first();
                if (empty($existencia)) {
                    $meeting_name = $m->meetingName;
                    $participant_count = $m->participantCount;
                    $listener_count = $m->listenerCount;
                    $voice_count = $m->voiceParticipantCount;
                    $context = 'bbb-context';
                    $moodle_context = $m->metadata->$context;
                    $d = date_parse($m->createDate);
                    $create_date = date('Y-m-d H:i:s', mktime($d['hour'], $d['minute'], $d['second'], $d['month'], $d['day'], $d['year']));
                    $fila = compact('meeting_id', 'meeting_name', 'participant_count', 'listener_count', 'voice_count', 'moodle_context', 'create_date');

                    $nuevaSala = Sala::firstOrCreate($fila);
                    $nuevaSala->save();
                }
            }
        }
    }
}
