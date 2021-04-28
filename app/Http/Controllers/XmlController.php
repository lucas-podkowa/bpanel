<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        //echo $nodes;
        foreach ($nodes->meetings as $meets) {
            foreach ($meets as $m) {
                echo 'Nombre de la clase: '.$m->meetingName.'<br />';
                echo '¿Grabando?: '.$m->recording.'<br />';
                echo 'Cantidad de participantes: '.$m->participantCount.'<br />';
                echo 'Microfonos Abiertos: '.$m->voiceParticipantCount.'<br />';
                
                
                //$participantes =$m->children();
                //echo $m->attendees->attendee->fullName;
               
               foreach ($m->attendees->attendee as $p) {
                    //echo $p->fullName;
                    if ($p->role == 'MODERATOR') {
                        echo 'Moderador: '.$p->fullName.'<br />';
                    }
                }

                echo '<br />';
                //echo $m->meetingName.'<br />';
            }
            
        }
    }
}


