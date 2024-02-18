@extends('adminlte::page')

@section('title', 'Trabajadores docentes')


@section('content')
@if(session()->has( 'error' ))
<x-alert.error>
    {{session()->get('error')}}
</x-alert.error>
@endif
<div class="login-container">
    <form class="login-form" method="post" action="{{route('nonteaching.store')}}">
        @csrf
        {{-- <h1></h1> --}}
        <h1>Introduzca los datos del trabajador</h1>
        <div class="input-group">
            <label for="">Nombre</label>
            <input type="text" name="nombre" placeholder="Nombre" required>          
        </div>

        <div class="input-group">
            <label for="">Carnet de identidad</label>
            <input type="text" name="ci" placeholder="carnet de identidad" required>          
        </div>


        <div class="input-group">
            <label for="">Grado escolar</label>
            <select class="input-select" name="nivel_escolar">
                <option value="9no Grado">9no Grado</option>
                <option value="Tecnico Medio">Tecnico Medio</option>
                <option value="12mo Grado">12mo Grado</option>
                <option value="Universitario">Universitario</option>
            </select>
        </div>

        <div class="input-group">
            <label for="">Ocupacion</label>
            <select class="input-select" name="ocupacion">
                <option value="Administrador">Administrador</option>
                <option value="TCI">TCI</option>
                <option value="Auxiliar de Servicios">Auxiliar de Servicios</option>
            </select>
        </div>


        <div class="input-group">
            <label for="">Provincia</label>
            <input type="text" name="provincia" placeholder="Provincia" required>
        </div>
        
        <div class="input-group">
            <label for="">Municipio</label>
            <input type="text" name="municipio" placeholder="Municipio" required>
        </div>

        <div class="input-group">
            <label for="">Direccion</label>
            <input type="text" name="direccion" placeholder="Calle y numero" required>
        </div>
        
        
        
        <button class="btn-success" type="submit">Aceptar</button>
        <div class="bottom-text">
            
        </div>
    </form>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{asset('css/create.css')}}">

@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop