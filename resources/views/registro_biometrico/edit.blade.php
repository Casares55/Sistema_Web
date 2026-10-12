@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Editar Registro Biométrico</h1>
        <form action="{{ route('registro_biometrico.update', $registro_biometrico) }}" method="POST">
            @method('PUT')
            @include('registro_biometrico._form')
        </form>
    </div>
@endsection
