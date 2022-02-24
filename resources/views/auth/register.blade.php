@php
    //Abrimos una linea de codigo PHP para extraer los datos de todos los paises. 
    use App\Models\Paises;
    $PAIS = Paises::All();
@endphp

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registrar Usuario</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        
                        <div class="row mb-3">
                            <label for="cedula" class="col-md-4 col-form-label text-md-end">Cédula</label>

                            <div class="col-md-6">
                                <input id="cedula" type="text" class="form-control @error('cedula') is-invalid @enderror" name="cedula" value="{{ old('cedula') }}" required autocomplete="name" autofocus>

                                @error('cedula')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="celular" class="col-md-4 col-form-label text-md-end">Celular</label>

                            <div class="col-md-6">
                                <input id="celular" type="text" class="form-control @error('celular') is-invalid @enderror" name="celular" value="{{ old('celular') }}" autocomplete="name" autofocus>

                                @error('celular')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="f_nacimiento" class="col-md-4 col-form-label text-md-end">Fecha de Nacimiento</label>

                            <div class="col-md-6">
                                <input id="f_nacimiento" type="date" class="form-control @error('f_nacimiento') is-invalid @enderror" name="f_nacimiento" value="{{ old('f_nacimiento') }}" required  max="2004-02-28">

                                @error('f_nacimiento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="f_nacimiento" class="col-md-4 col-form-label text-md-end">País</label>
                            <div class="col-md-6">
                                <select name="ciudad" class="form-select" aria-label="Default select example" required  onchange="Buscar_Estados(value);">
                                    <option value="0">Escoja un país</option>   
                                    @foreach ($PAIS as $p) 
                                        <option value="{{ $p->id }}">{{ $p->nombre }}</option>                                    
                                    @endforeach  
                                </select>
                            </div>
                        </div>     

                        <div class="row mb-3">
                            <label for="estado" class="col-md-4 col-form-label text-md-end">Estádo</label>
                            <div class="col-md-6">
                                <select name="estado" id="Estado" class="form-select" aria-label="Default select example" required onchange="Buscar_Ciudad(value);">

                                </select>
                            </div>
                        </div> 
                        
                        
                        <div class="row mb-3">
                            <label for="ciudad" class="col-md-4 col-form-label text-md-end">Ciudad</label>
                            <div class="col-md-6">
                                <select name="ciudad" id="Ciudad" class="form-select" aria-label="Default select example" required>

                                </select>
                            </div>
                        </div> 
                        

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

function Buscar_Estados(val){
    $('#Estado option').remove();
    $('#Ciudad option').remove();
    $.ajax({
        url: '{{url('Estados/')}}'+'/'+val,
        success:function(data){
            console.log(data);
            $('#Estado option').remove();
            $('#Estado').append("<option value='0'>Escoja un estado</option>");
            for (var i=0; i < data.length; i++) {
                $('#Estado').append("<option value='" + data[i].id + "' >" + data[i].nombre + "</option>");
            }
        }
    });
}

function Buscar_Ciudad(val){
    $.ajax({
        url: '{{url('Ciudades/')}}'+'/'+val,
        success:function(data){
            console.log(data);
            $('#Ciudad option').remove();
            for (var i=0; i < data.length; i++) {
                $('#Ciudad').append("<option value='" + data[i].id + "'>" + data[i].nombre + "</option>");
            }
        }
    });
}
</script>

@endsection
