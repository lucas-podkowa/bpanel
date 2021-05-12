<?php

namespace App\Http\Controllers;

use App\Asistente;
use App\Sala;
use Illuminate\Http\Request;

class AsistenteController extends Controller
{
    public function index()
    {
        //$salas = Asistente::get();
        //$salas = Asistente::paginate(10);

        //$url = 'https://bbb.fio.unam.edu.ar/bigbluebutton/api/getMeetings?checksum=7af8345722fb7dcdd1baa3a26342c5092842820f';
        $url = "file:///home/lucas/Documentos/bpanel/public/reuniones.xml";
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

        $this->array_sort_by($asistentes, 'full_name', SORT_ASC);
        return view('asistente', compact('asistentes'));
    }

    public function show($id=null)
    {
        $asistentes = Asistente::where('sala_id', $id)->get();
        
        return view('asistente', compact('asistentes'));
    }

    public function store($var = null)
    {
        $url = "file:///home/lucas/Documentos/bpanel/public/reuniones.xml";
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
                            $a = compact('user_id','sala_id','full_name', 'role');
                            //array_push($asistentes, $a);

                            $na = Asistente::firstOrCreate($a);
                            $na->save();
                        }
                    }                    
                }
            }
        }

        $this->array_sort_by($asistentes, 'full_name', SORT_ASC);
        
        
        return view('asistente', compact('asistentes'));
    }



    private function array_sort_by(&$origen, $col, $order)
    {
        $arrAux = array();
        foreach ($origen as $key => $row) {
            $arrAux[$key] = is_object($row) ? $arrAux[$key] = $row->$col : $row[$col];
            $arrAux[$key] = strtolower($arrAux[$key]);
        }
        array_multisort($arrAux, $order, $origen);
    }

}
