@extends('layouts.app')

@section('content')

    <!-- Seccion para Administradores -->
    @if(Auth::user()->rol == "ADMINISTRADOR")
        <div class="container">  
            <div style="padding: 20px;">
                <div class="card" >
                    <div class="card-header">Lista de Usuario</div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-6">    
                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label text-md-end">Buscar</label>

                                    <div class="col-md-6">
                                        <input id="input-search" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>  
                            </div> 
                        </div>
            
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
                                    <th class="Titulo-table-Reg">Edit</th>       
                                    <th class="Titulo-table-Reg">Delete</th>                                                  
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
                                        <td>
                                            <a class='item' href='{{url('/EditarUser/'.$data->id)}}'>    
                                                <div> <img src='{{url('/Images/Edit.png') }}'  width='20' height='20'/></div>
                                            </a>   
                                        </td>   
                                        <td>
                                            <a class='item' href='{{url('/DeleteUser/'.$data->id)}}'>    
                                                <div> <img src='{{url('/Images/Delete.png') }}'  width='20' height='20'/></div>
                                            </a>   
                                        </td>                                                      
                                    </tr>
                                @endforeach                
                            </tbody>
                        </table>  
                        <div id="Links">         
                            {{ $Users->links("pagination::bootstrap-5") }}
                        </div> 
                    </div> 
                </div>
            </div>
            
            <!-- panel Emails -->
            <div style="padding: 20px;">
                <div class="card" >
                    <div class="card-header">Emails Enviados</div>
                    <div class="card-body">
                        <table id="tblemails" class="display"></table>
                    </div>
                </div>    
            </div>            

        </div>

        <script>
            //Buscar un cliente para Asociarlo a un Negocio....
            $("#input-search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                if(value != ''){        
                    $.ajax({         
                        url: '{{url('/Buscar/')}}'+'/'+value,
                        success:function(data){
                            $('#ListInvent tbody tr').remove();
                            $('#Links').hide();     
                            if(data.data.length > 0 )   {               
                                for (var i=0; i < data.data.length; i++) {
                                    console.log(1)
                                    $('#ListInvent tbody').append("<tr> <td>"+data.data[i].name+"</td> <td>"+data.data[i].email+"</td> <td>"+data.data[i].cedula+"</td> <td>"+data.data[i].numero_celular+"</td> <td>"+data.data[i].rol+"</td> <td>"+data.data[i].f_nacimiento+"</td>  <td> - </td> <td> "+data.data[i].cod_ciudad+" </td> <td> <a class='item' href='{{url('/EditarUser/')}}/"+ data.data[i].id +"'> <div> <img src='{{url('/Images/Edit.png') }}'  width='20' height='20'/></div> </a> </td> <td> <a class='item' href='{{url('/DeleteUser/')}}/"+ data.data[i].id +"'> <div> <img src='{{url('/Images/Delete.png') }}'  width='20' height='20'/></div> </a> </td>  </tr>");
                                }
                            } else{
                                $('#ListInvent tbody').append("<tr> <td>No hay busqueda relacionada.</td></tr>");  
                            }
                        } 
                    });
                }
            });


            var table = $('#tblemails').DataTable({

                columns: [

                        { title: "ASUNTO" },            
                        { title: "DESTINATARIO" },
                        { title: "MENSAJE" },                    
                        { title: "ESTADO" }

                    ]
                });

                $.ajax({
                    url: '{{url('/Emailsall')}}',
                    success:function(data){
                        console.log(data);
                        //$('#example > tbody > tr').remove();
                        for (let i = 0; i < data.length; i++) {
                            table.row.add([
                                data[i]['asunto'],
                                data[i]['destinatario'],
                                data[i]['mensage'],
                                data[i]['estado']
                            ]).draw( false );
                        }
                    }
                });




        </script>

    @endif


    <!-- Seccion para Usuarios -->
    @if(Auth::user()->rol == "USUARIO")
        <div class="container">  
            @php
                $Users = [];
            @endphp
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card border-primary mb-3">
                            <div class="card-header text-white bg-primary mb-3">Enviar un email</div>
                            <div class="card-body">
                                <form method="POST">
                                    @csrf
                                    <input type="hidden" name="id_user"  value="{{Auth::user()->id}}">
                                    <div class="row mb-3">
                                        <label for="asunto" class="col-md-4 col-form-label text-md-end">Asunto: </label>
                                        <div class="col-md-6">
                                            <input id="asunto" type="text" class="form-control @error('email') is-invalid @enderror" name="asunto" value="" required autocomplete="email" autofocus>
                                            @error('asunto')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="row mb-3">
                                        <label for="destino" class="col-md-4 col-form-label text-md-end">Destinatario: </label>
            
                                        <div class="col-md-6">
                                            <input id="destino" type="email" class="form-control @error('destino') is-invalid @enderror" name="destino" required autocomplete="current-password">
            
                                            @error('destino')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
            

                                    <div class="row mb-3">
                                        <label for="body" class="col-md-4 col-form-label text-md-end">Mensage: </label>
            
                                        <div class="col-md-6">
                                            <input id="body" type="text" class="form-control @error('body') is-invalid @enderror" name="body" required autocomplete="current-password">
            
                                            @error('body')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                Enviar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- panel Emails -->
                <div style="padding: 20px;">
                    <div class="card" >
                        <div class="card-header">Emails Enviados</div>
                        <div class="card-body">
                            <table id="tblemails" class="display"></table>
                        </div>
                    </div>    
                </div>

            </div>
        </div>
               
        <script>

            var id = {{Auth::user()->id}};
            var table = $('#tblemails').DataTable({

                columns: [

                        { title: "ASUNTO" },            
                        { title: "DESTINATARIO" },
                        { title: "MENSAJE" },                    
                        { title: "ESTADO" }

                    ]
                });

            $.ajax({
                    url: '{{url('/Emailusuario')}}'+'/'+id,
                    success:function(data){
                        console.log(data);
                        //$('#example > tbody > tr').remove();
                        for (let i = 0; i < data.length; i++) {
                            table.row.add([
                                data[i]['asunto'],
                                data[i]['destinatario'],
                                data[i]['mensage'],
                                data[i]['estado']
                            ]).draw( false );
                        }
                    }
                });





        </script>


        
    @endif


@endsection
