@extends('errors.layout')

@section('title', 'Error del servidor')
@section('code', '500')
@section('message', 'Ocurrió un error interno. Estamos trabajando para solucionarlo.')

@section('icon')
    <img src="{{ asset('image/500.jpg') }}" alt="Error Servidor" class="mx-auto mb-6 max-w-xs w-full" />
@endsection
