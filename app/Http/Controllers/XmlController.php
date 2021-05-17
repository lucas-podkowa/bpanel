<?php

namespace App\Http\Controllers;

use DateTimeZone;

class XmlController extends Controller
{
    public function index()
    {
        $url = 'https://bbb.fio.unam.edu.ar/bigbluebutton/api/getMeetings?checksum=7af8345722fb7dcdd1baa3a26342c5092842820f';
        $xml = simplexml_load_file($url);

        $nodes = $xml->children();
        $filas = array();
        $personas = $microfonos = $reuniones = 0;
        //echo $nodes;
        foreach ($nodes->meetings as $meets) {
            foreach ($meets as $m) {;
                $moderadores = array();
                $nombreSesion = $m->meetingName;
                $meetingID = $m->meetingID;

                $context = 'bbb-context';
                $moodle_context = $m->metadata->$context;

                $p = date_parse($m->createDate);
                $fecha = date('Y-m-d H:i:s', mktime($p['hour'], $p['minute'], $p['second'], $p['month'], $p['day'], $p['year']));

                $cantParticipantes = $m->participantCount;
                $microfonosAbiertos = $m->voiceParticipantCount;
                $reuniones++;
                $microfonos += $microfonosAbiertos;
                $personas += $cantParticipantes;

                foreach ($m->attendees->attendee as $p) {
                    if ($p->role == 'MODERATOR') {
                        array_push($moderadores, $p->fullName);
                    }
                }


                $fila = compact('nombreSesion', 'cantParticipantes', 'moderadores', 'moodle_context', 'meetingID');
                array_push($filas, $fila);
            }
        }
        $totales = compact('personas', 'reuniones', 'microfonos');

        $title = (date_format(date_create()->setTimezone(new DateTimeZone("America/Argentina/Buenos_Aires")), 'd/m/Y | H:i'));
        return view('sesiones', compact('filas', 'title', 'totales'));
    }
}
