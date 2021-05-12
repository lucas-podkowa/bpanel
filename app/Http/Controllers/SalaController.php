<?php

namespace App\Http\Controllers;

use App\Asistente;
use App\Sala;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    /**
     * Utilizado para listar salas
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //busca los registros en la tabla y los trae todos segun el orden de la BD
        $salas = Sala::get();

        //una forma de llamar todos los elementos paginados segun la cantidad que le pase por parametro
        //$salas = Sala::paginate(10);

        return view('sala', compact('salas'));
    }

    /**
     * Muestre el formulario para crear una nueva sala.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
    }

    /**
     * Guardar la sala recien enviada previamente por el create y lo almacenara en la base de datos
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**º
     * Muestra una sala especifica encontrado por su identificador, en esre caso sala_id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {
        //foreach (Sala::all() as $s) {
        //    echo $s->meeting_id;
        //}
        
    }

    /**
     * Muestre el formulario para editar una sala especifica que ya existe.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Utilizado para guardar en la BD los cambios realizados en el formulario con el metodo edit().
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function actualizar()
    {
        //$url = 'https://bbb.fio.unam.edu.ar/bigbluebutton/api/getMeetings?checksum=7af8345722fb7dcdd1baa3a26342c5092842820f';
        $url = "file:///home/lucas/Documentos/bpanel/public/reuniones.xml";
        $xml = simplexml_load_file($url);

        $nodes = $xml->children();
        $filas = $todos= array();

        foreach ($nodes->meetings as $meets) {
            foreach ($meets as $m) {;
                $meeting_id = $m->meetingID;

                $existencia = Sala::where('meeting_id', $meeting_id)->first();
                //if (empty($existencia)) {
                    $meeting_name = $m->meetingName;
                    $participant_count = $m->participantCount;
                    $listener_count = $m->listenerCount;
                    $voice_count = $m->voiceParticipantCount;
                    $context = 'bbb-context';
                    $moodle_context = $m->metadata->$context;
                    $d = date_parse($m->createDate);
                    $create_date = date('Y-m-d H:i:s', mktime($d['hour'], $d['minute'], $d['second'], $d['month'], $d['day'], $d['year']));
                    $fila = compact('meeting_id','meeting_name', 'participant_count', 'listener_count', 'voice_count', 'moodle_context', 'create_date');
                    
                    array_push($filas, $fila);

                    //dd($fila);

                    $nuevaSala = Sala::firstOrCreate($fila);
                    //dd($nuevaSala);
                    $nuevaSala->save();

                    //$asistentes = Asistente::where('sala_id', $existencia->sala_id)->get();
                    
                //}else{
                    //echo 'vacio';
                //}        
            }
            //$sala = new Sala($fila);
            //$sala->save();
        }

        //$existencia = Sala::where('meeting_id', $meeting_id)->first();
        //echo $existencia->sala_id;


        //$salas = Sala::get();
        //foreach ($variable as $key => $value) {
        //    # code...
        //}

    }
}
