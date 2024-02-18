@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    {{-- <h1>Dashboard</h1> --}}
    <h1>Bienvenido</h1>
@stop

@section('content')
@if (session()->has('success'))
<x-alert.success></x-alert.success>
@endif
@if (session()->has('error'))
<x-alert.error>
     {{session()->get('error')}}
</x-alert.error>
@endif

@hasrole('master')
<p>Eliminar trabajador dado el carnet de identidad</p>
<div class="login-container">
        <form class="login-form" method="post" action="{{route('destory')}}">
            @csrf
            @method('delete')
            {{-- <h1></h1> --}}
            <h1>Introzca el CI del trabajador a eliminar</h1>
            <div class="input-group">
                {{-- <label for="">CI</label> --}}
                <input type="text" name="ci" placeholder="carnet de identidad" required>          
            </div>
    
            
            <button class="btn-success" type="submit">Aceptar</button>
            <div class="bottom-text">
                
            </div>
        </form>
    </div>
    
    @endhasrole
    @stop

@section('css')
<link rel="stylesheet" href="{{asset('css/create.css')}}">

    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop