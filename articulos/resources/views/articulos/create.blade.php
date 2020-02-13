@extends('plantillas.plantilla')
@section('titulo')
Bazar García
@endsection
@section('cabecera')
Crear Artículo
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
<form name="c" method='POST' action="{{route('articulos.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
      <div class="col">
        <input type="text" class="form-control" placeholder="Nombre" name='nombre' required>
      </div>
        <div class="col">
          <select name='categoria' class="form-control">
            <option selected>Electrónica</option>
            <option>Hogar</option>
            <option>Bazar</option>
        </select>
        </div>
    </div>
    <div class="form-row mt-2">
        <div class="col">
            <input type="number" class="form-control" placeholder="Precio" name='precio' min="1" step="0.01" required>
        </div>
        <div class="col">
          <input type="number" class="form-control" placeholder="Stock" name='stock' min="0" step="1" required>
        </div>
      </div>
      <div class="form-row mt-3">
        <div class="col">
            <b>Imagen producto</b>&nbsp;<input type='file' name='imagen' accept="image/*">
        </div>
      </div>
      <div class="form-row mt-3">
        <div class="col">
            <input type='submit' value='Guardar' class='btn btn-success mr-3'>
            <input type='reset' value='Limpiar' class='btn btn-warning mr-3'>
            <a href={{route('articulos.index')}} class='btn btn-info'>Volver</a>
        </div>
    </div>
  </form>
@endsection