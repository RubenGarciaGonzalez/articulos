@extends('plantillas.plantilla')
@section('titulo')
Marcas
@endsection
@section('cabecera')
Artículos
@endsection
@section('contenido')
@if($texto=Session::get('mensaje'))
<p class="alert alert-success my-2">{{$texto}}</p>
@endif
<div class="container">
<a href="{{route('articulos.create')}}" class="btn btn-success mb-1">Crear Artículo</a>
</div>
<table class="table table-striped table-dark mt-3">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Categoría</th>
        <th scope="col">Precio(€)</th>
        <th scope="col">Stock</th>
        <th scope="col">Imagen</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
        @foreach($articulos as $articulo)
      <tr>
        <th scope="row" class="align-middle">
        <a href="{{route('articulos.show', $articulo)}}" class="btn btn-info">Detalles</a>
        </th>
    <td class="align-middle">{{$articulo->nombre}}</td>
    <td class="align-middle">{{$articulo->categoria}}</td>
    <td class="align-middle">{{$articulo->precio}}</td>
    <td class="align-middle">{{$articulo->stock}}</td>
    <td>
        <img src="{{asset($articulo->imagen)}}" width="90px" height='90px' class="rounded-circle">
    </td>
    <td class="align-middle" style="white-space: nowrap">
        <form name="borrar" method='post' action='{{route('articulos.destroy', $articulo)}}'>
            @csrf
            @method('DELETE')
            <a href='{{route('articulos.edit', $articulo)}}' class="btn btn-warning">Editar</a>
            <button type='submit' class="btn btn-danger" onclick="return confirm('¿Borrar Marca?')">Borrar</button>
        </form>
    </td>
      </tr>
     @endforeach
    </tbody>
  </table>
  {{$articulos->links()}}
@endsection