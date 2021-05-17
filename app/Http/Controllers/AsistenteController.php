<?php

namespace App\Http\Controllers;


class AsistenteController extends Controller
{
    public function index()
    {
        $url = 'https://bbb.fio.unam.edu.ar/bigbluebutton/api/getMeetings?checksum=7af8345722fb7dcdd1baa3a26342c5092842820f';
        $xml = simplexml_load_file($url);
        $nodes = $xml->children();
        $asistentes = array();
        foreach ($nodes->meetings as $meets) {
            foreach ($meets as $m) {;
                foreach ($m->attendees->attendee as $p) {
                    $full_name = $p->fullName;
                    $role = $p->role;
                    $a = compact('full_name', 'role');
                    array_push($asistentes, $a);
                }
            }
        }
        return view('asistente', compact('asistentes'));
    }
}
