@extends('layout')

@section('content')
    
<table class="table table-sm" >
    <thead class="thead-dark">
        <th>Nombre y Apellido</th>
        <th>Rol</th>
        
    </thead>
        <tbody >
            @forelse ($asistentes as $a)

                <tr>
                    <td >
                        {{$a['full_name']}}
                    </td>
                    <td >
                        {{$a['role']}}
                    </td>
                </tr>  
            @empty
                <li>No hay salas para mostrar</li>
            @endforelse
    </tbody>
</table>


@endsection