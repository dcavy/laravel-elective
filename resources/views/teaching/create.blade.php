@extends('adminlte::page')

@section('title', 'Trabajadores docentes')


@section('content')

<div class="login-container">
    <form class="login-form" method="post" action="{{route('teaching.store')}}">
        @csrf
        {{-- <h1></h1> --}}
        <h1>Introzca los datos del trabajador</h1>
        <div class="input-group">
            <label for="">Nombre</label>
            <input type="text" name="nombre" placeholder="Nombre" required>          
        </div>

        <div class="input-group">
            <label for="">Carnet de identidad</label>
            <input type="text" name="ci" placeholder="carnet de identidad" required>          
        </div>


        <div class="input-group">
            <label for="">Categoria docente</label>
            <select class="input-select" name="categoria_docente">
                <option value="Instructor">Instructor</option>
                <option value="Asistente">Asistente</option>
                <option value="Auxiliar">Auxiliar</option>
                <option value="Titular">Titular</option>
            </select>
        </div>

        <div class="input-group">
            <label for="">Categoria cientifica</label>
            <select class="input-select" name="categoria_cientifica">
                <option value="Master">Master</option>
                <option value="Doctor">Doctor</option>
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