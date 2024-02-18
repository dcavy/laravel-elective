@extends('adminlte::page')

@section('title', 'Trabajadores no docentes')

@section('content_header')
    <h1>Trabajadores no docentes</h1>
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

    <form action="{{route('nonteaching.create')}}" method="get">
        <button type="submit" class="btn btn-success">Agregar nuevo trabajador no docente</button>
    </form>

    {{-- <form action="{{route('nonteaching.index', false)}}" method="get">
        <button type="submit" class="btn btn-success">Ordenar alfaveticamente</button>
    </form> --}}


<div class="container table-responsive py-5"> 
<table id="table" class="table table-bordered table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">CI</th>
      <th scope="col">Grado Escolar</th>
      <th scope="col">Ocupacion</th>
      <th scope="col">Provincia</th>
      <th scope="col">Municipio</th>
      <th scope="col">Direccion</th>

    </tr>
  </thead>
  <tbody>
    @foreach ($workers as $worker )
        
    <tr>
        <th scope="row">{{$loop->index+1}}</th>
        <td>{{$worker['name']}}</td>
        <td>{{$worker['ci']}}</td>
        <td>{{$worker['school_level']}}</td>
        <td>{{$worker['ocupation']}}</td>
        <td>{{$worker['province']}}</td>
        <td>{{$worker['municipality']}}</td>
        <td>{{$worker['address']}}</td>
    </tr>
    @endforeach
   
     
   
  </tbody>
</table>
</div>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')  
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
    $('#table').DataTable();
</script>
@stop