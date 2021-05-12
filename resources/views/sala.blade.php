@extends('cabecera')


@section('content')

<table class="table table-hover" >
       
    <thead class="thead-dark">
        <th>Nombre de la Sala</th>
        <th>Contexto</th>
        <th>Nº de Participantes</th>
        <th>Como Oyentes</th>
        <th>Fecha de Creación</th>
    </thead>
    <tbody >
        @forelse ($salas as $s)
        <tr>
            <td>
                {{$s->meeting_name}}
            </td>
            <td>
                {{$s->moodle_context}}
            </td>
            <td>
                {{$s->participant_count}}
            </td>
            <td>
                {{$s->listener_count}}
            </td>
            <td>
                {{$s->create_date}}
            </td>
        </tr>  
    @empty
        <li>No hay salas para mostrar</li>
    @endforelse
    </tbody>
</table>


   

@endsection