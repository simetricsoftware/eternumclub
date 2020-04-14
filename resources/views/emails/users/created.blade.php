@extends('emails.layouts.layout')
@section('content')
    <h1>Hola {{ $user->full_name }}</h1>
    <p>Se te a proporcionado un usuario puedes ingresar con las siguientes credenciales</p>
    <strong>Correo:</strong> {{ $user->email }}
    <strong>Clave:</strong> {{ $password }}
@endsection
