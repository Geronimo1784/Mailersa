@extends('layouts.app')

@section('content')


    <!-- Seccion para Administradores -->
    @if(Auth::user()->rol == "ADMINISTRADOR")
        <div class="container">       
            <div>Panel para Adminstrador</div>    
            
            <table id="ListInvent" class="ui celled table">
                <thead>
                    <tr style="text-align: center;">
                        <th class="Titulo-table-Reg">Nombre</th>
                        <th class="Titulo-table-Reg">Email</th>
                        <th class="Titulo-table-Reg">Cedula</th>
                        <th class="Titulo-table-Reg">Numero Celular</th>
                        <th class="Titulo-table-Reg">Rol</th>
                        <th class="Titulo-table-Reg">F Nacimiento</th>
                        <th class="Titulo-table-Reg">Edad</th>
                        <th class="Titulo-table-Reg">Ciudad</th>            
                    </tr>
                </thead> 
                <tbody>
                    @foreach ($Users as $data)          
                        <tr style="text-align: center;">
                            <td>{{$data->name}}</td>
                            <td>{{$data->email}}</td>
                            <td>{{$data->cedula}}</td>
                            <td>{{$data->numero_celular}}</td>
                            <td>{{$data->rol}}</td>
                            <td>{{$data->f_nacimiento}}</td>
                            <td>-</td>
                            <td>{{$data->cod_ciudad}}</td>
                        </tr>
                    @endforeach                
                </tbody>
            </table>            
            {{ $Users->links("pagination::bootstrap-5") }}

        </div> 




    @endif


    <!-- Seccion para Usuarios -->
    @if(Auth::user()->rol == "USUARIO")
        <div class="container">  
            @php
                $Users = [];
            @endphp
            
            <div>Panel para USUARIOS</div>
        </div>
    @endif


@endsection
