@extends('cabecera')

@section('content')
    <h1>
        {{$title}}
        <button type="button" class="btn btn-info">Actualizar</button>
    </h1>    

    <table class="table table-hover" >
       
        <thead class="thead-dark">
            <th>Contexto (Curso de origen)</th>
            <th>Nombre de la Sala</th>
            <th>Moderadores</th>
            <th>Nº de Participantes</th>
        </thead>
        <tbody >
            @forelse ($filas as $f)
                <tr>
                    <td>
                        {{$f['moodle_context']}}
                    </td>
                    <td>
                        {{$f['nombreSesion']}}
                    </td>
                    <td>
                        @foreach ($f['moderadores'] as $m)
                            <li>
                                {{$m}}
                            </li>  
                        @endforeach
                    </td>          

                    <td>
                        <button type="button" class="btn btn-info" >
                            <strong>
                                <a href="{{ route('asistentes.show', 2)}}">
                                    {{$f['cantParticipantes']}}
                                </a> 
                            </strong>
                        </button>
                        
                    </td>

                </tr>   
            @empty
                <td>No existen sesiones activas</td>
            @endforelse
        </tbody>
    </table>
    <div>
        <div class="alert alert-primary" role="alert">
            Sesiones activas: <b>{{$totales['reuniones']}}</b>
        </div>
        <div class="alert alert-primary" role="alert">
            Total de participantes: <b>{{$totales['personas']}}</b>
         </div>
         <div class="alert alert-primary" role="alert">
            Microfonos con permiso de activación: <b>{{$totales['microfonos']}}</b>
         </div>
    </div>
@endsection


   
    


