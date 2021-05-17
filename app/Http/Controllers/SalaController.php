<?php

namespace App\Http\Controllers;

use App\Asistente;
use App\Sala;

class SalaController extends Controller
{
    public function index()
    {
        $salas = Sala::get();
        return view('sala', compact('salas'));
    }

    public function show($id = null)
    {
        $asistentes = array();
        if (is_numeric($id)) {
            $asistentes = Asistente::where('sala_id', $id)->get();
        } else {
            $url = 'https://bbb.fio.unam.edu.ar/bigbluebutton/api/getMeetings?checksum=7af8345722fb7dcdd1baa3a26342c5092842820f';
            $xml = simplexml_load_file($url);

            $nodes = $xml->children();
            foreach ($nodes->meetings as $meets) {
                foreach ($meets as $m) {;

                    if ($id == $m->meetingID) {
                        foreach ($m->attendees->attendee as $p) {
                            $full_name = $p->fullName;
                            $role = $p->role;
                            $a = compact('full_name', 'role');
                            array_push($asistentes, $a);
                        }
                    }
                }
            }
        }
        return view('asistente', compact('asistentes'));
    }

}
