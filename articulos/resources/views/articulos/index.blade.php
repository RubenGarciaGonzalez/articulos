@extends('plantillas.plantilla')
@section('titulo')
Bazar García
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
<form name="search" method="get" action="{{route('articulos.index')}}" class="form-inline float-right">
  <i class="fa fa-search fa-2x ml-2 mr-2" aria-hidden="true"></i>
  <label for="categoria" class="mr-2">Categoria</label>
  <select name='categoria' class='form-control mr-2' onchange="this.form.submit()">
    <option value='%'>Todos</option>
    @foreach($categorias as $categoria)
      @if($categoria==$request->categoria)
        <option selected>{{$categoria}}</option>
      
      @else
        <option >{{$categoria}}</option>
      @endif
    @endforeach
  </select> 
  <label for="precio" class="mr-2">Precio</label>
  <select name='precio' class='form-control mr-2' onchange="this.form.submit()">
    @foreach($precios as $p => $pv)
      @if($p==$request->precio)
        <option value={{$p}} selected>{{$pv}}</option>
      @else
      <option value={{$p}} >{{$pv}}</option>        
      @endif
    @endforeach
  </select> 
  <input type="submit" value="Buscar" class="btn btn-info ml-2">
</form>
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
  {{$articulos->appends(Request::except('page'))->links()}}
@endsection