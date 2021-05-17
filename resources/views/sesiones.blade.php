@extends('layout')

@section('content')
    <h1>
        {{ $title }}
    </h1>

    <table id="rtimetable" class="table table-bordered table-hover">

        <thead class="thead-dark">
            <th>Nombre de la Sala</th>
            <th>Contexto (Curso de origen)</th>
            <th>Moderadores</th>
            <th>Nº de Participantes</th>
        </thead>
        <tbody>
            @forelse ($filas as $f)
                <tr>
                    <td>
                        {{ $f['nombreSesion'] }}
                    </td>
                    <td>
                        {{ $f['moodle_context'] }}
                    </td>
                    <td>
                        @foreach ($f['moderadores'] as $m)
                            <li>
                                {{ $m }}
                            </li>
                        @endforeach
                    </td>
                    <td>
                        <a class="btn btn-block btn-outline-primary btn-sm"
                            href="{{ route('asistentes.show', $f['meetingID']) }}" role="button">
                            <strong> {{ $f['cantParticipantes'] }}</strong>
                        </a>
                    </td>
                </tr>
            @empty
            <div class="alert alert-secondary" role="alert">
                No existen sesiones activas en este momento
            </div>    
            @endforelse
        </tbody>
    </table>
    <div>
        <div class="alert alert-light" role="alert">
            Sesiones activas: <b>{{ $totales['reuniones'] }}</b>
        </div>
        <div class="alert alert-light" role="alert">
            Total de participantes: <b>{{ $totales['personas'] }}</b>
        </div>
        <div class="alert alert-light" role="alert">
            Microfonos con permiso de activación: <b>{{ $totales['microfonos'] }}</b>
        </div>
    </div>
@endsection
