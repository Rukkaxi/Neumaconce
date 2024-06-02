@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Cotiza con nosotros</h2>
    <form action="#" method="POST" class="cotizacion-form">
        @csrf
        <div class="form-group">
            <label for="name">Nombres:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="name">Apellidos:</label>
            <input type="text" class="form-control" id="lastname" name="lastname" required>
        </div>
        <div class="form-group">
            <label for="email">Correo electrónico:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="phone">Número de contacto:</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="+56" required>
        </div>
        <div class="form-group">
            <label for="product">Producto:</label>
            <input type="text" class="form-control" id="product" name="product" placeholder="Indique el nombre y modelo del producto que desea cotizar" required>
        </div>

        <div class="form-group">
            <label for="description">Descripción de la cotización</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Señale una pequeña descripción de su solicitud." require></textarea>
        </div>

        <div class="form-group text-right">
            <button type="button" class="btn btn-secondary">Cancelar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </form>
</div>
@endsection