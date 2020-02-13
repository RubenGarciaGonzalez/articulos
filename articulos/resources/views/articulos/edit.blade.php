@extends('plantillas.plantilla')
@section('titulo')
Bazar García
@endsection
@section('cabecera')
Editar Artículo
@endsection
@section('contenido')
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $miError)
            <li>{{$miError}}</li>
            @endforeach
        </ul>
    </div>
@endif
<form name="c" method='POST' action="{{route('articulos.update', $articulo)}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-row">
      <div class="col">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" value="{{$articulo->nombre}}" name='nombre' required>
      </div>
        <div class="col">
          <label for="categoria">Categoria</label>
          <select name='categoria' class="form-control">
                @foreach($categorias as $categoria)
                @if($categoria==$articulo->categoria)
                  <option selected>{{$categoria}}</option>
                @else
                <option>{{$categoria}}</option> 
                @endif
                 @endforeach 
        </select>
        </div>
    </div>
    <div class="form-row mt-2">
        <div class="col">
            <label for="precio">Precio</label>
            <input type="number" class="form-control" value="{{$articulo->precio}}" name='precio' min="1" step="0.01" required>
        </div>
        <div class="col">
            <label for="precio">Stock</label>
          <input type="number" class="form-control"value="{{$articulo->stock}}" name='stock' min="0" step="1" required>
        </div>
      </div>
      <div class="form-row mt-3">
        <div class="col">
            <img src="{{asset($articulo->imagen)}}" width="40vw" height="40vh" class="rounded-circle mr-3">
            <b>Imagen producto</b>&nbsp;<input type='file' name='imagen' accept="image/*">
        </div>
      </div>
      <div class="form-row mt-3">
        <div class="col">
            <input type='submit' value='Modificar' class='btn btn-success mr-3'>
            <a href={{route('articulos.index')}} class='btn btn-info'>Volver</a>
        </div>
    </div>
  </form>
@endsection