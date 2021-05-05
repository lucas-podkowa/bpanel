<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use SimpleXMLElement;

class XmlController extends Controller
{
    public function index(){
        return "bienvenido a la pagina principal mediante controlador";
    }
    
    public function show(){
        return "pagina pasando un segundo metodo como controlador";
    }

    public function sesiones(){
        //$url = 'https://bbb.fio.unam.edu.ar/bigbluebutton/api/getMeetings?checksum=7af8345722fb7dcdd1baa3a26342c5092842820f';
        $url= "file:///home/lucas/Documentos/bpanel/public/reuniones.xml";
        $xml = simplexml_load_file($url);

        $nodes = $xml->children();
        $filas = array();
        $personas = $microfonos = $reuniones = 0;
        //echo $nodes;
        foreach ($nodes->meetings as $meets) {
            foreach ($meets as $m) {
                ; 
                $moderadores = array();
                
                $nombreSesion = $m->meetingName;
                
                //$creado = $m->createTime;
                $p = date_parse($m->createDate) ;
                $fecha = date('Y-m-d H:i:s', mktime($p['hour'], $p['minute'], $p['second'], $p['month'], $p['day'], $p['year'])); 
                

                dd($fecha);

                //$grabando = ($m->recording) ? 'Si' : 'No' ;
                $cantParticipantes = $m->participantCount;
                $microfonosAbiertos = $m->voiceParticipantCount;
                $reuniones ++;
                $microfonos +=$microfonosAbiertos;
                $personas +=$cantParticipantes;
                
               foreach ($m->attendees->attendee as $p) {
                    if ($p->role == 'MODERATOR') {
                        array_push($moderadores, $p->fullName);
                    }
                }
                
               $fila = compact('nombreSesion', 'cantParticipantes', 'microfonosAbiertos', 'moderadores');
               array_push($filas, $fila);
            }
            
        }
        $totales = compact('personas', 'reuniones', 'microfonos');
        //dd($totales);
        
        $title = date_format(date_create(), 'd/m/Y H:i a');
        
        return view('sesiones', compact('filas', 'title', 'totales'));
    }

    public function respaldar(){
        $url = 'https://bbb.fio.unam.edu.ar/bigbluebutton/api/getMeetings?checksum=7af8345722fb7dcdd1baa3a26342c5092842820f';
        //$url= "file:///home/lucas/Documentos/bpanel/public/reuniones.xml";
        $xml = simplexml_load_file($url);

        $nodes = $xml->children();
        $filas = array();
        $personas = $microfonos = $reuniones = 0;
        
    }
}


