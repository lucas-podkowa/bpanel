@extends('layout')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Historial de Sesiones realizadas</h3>
        </div>

        <div class="card-body">
            <table id="example" class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre de la Sala</th>
                        <th>Contexto</th>
                        <th>Nº de Participantes</th>
                        <th>Como Oyentes</th>
                        <th>Fecha de Creación</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($salas as $s)
                        <tr>
                            <td>
                                {{ $s->meeting_name }}
                            </td>
                            <td>
                                {{ $s->moodle_context }}
                            </td>
                            <td>
                                <a class="btn btn-block btn-outline-primary btn-sm"
                                    href="{{ route('asistentes.show', $s->sala_id) }}" role="button">
                                    <strong>{{ $s->participant_count }}</strong>
                                </a>
                            </td>
                            <td>
                                {{ $s->listener_count }}
                            </td>
                            <td>
                                {{ $s->create_date }}
                            </td>
                        </tr>
                    @empty
                        <ul>No hay salas para mostrar</ul>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

@endsection
