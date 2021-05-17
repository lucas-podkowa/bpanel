@extends('layout')

@section('content')

    <div class="card-body">
        <table id="asisttable" class="table table-sm">
            <thead class="thead-dark">
                <th>Nombre y Apellido</th>
                <th>Rol</th>

            </thead>
            <tbody>
                @forelse ($asistentes as $a)
                    <tr>
                        <td>
                            {{ $a['full_name'] }}
                        </td>
                        <td>
                            {{ $a['role'] }}
                        </td>
                    </tr>
                @empty
                <div class="alert alert-info" role="alert">
                    No existen asistentes activos en este momento
                </div>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
