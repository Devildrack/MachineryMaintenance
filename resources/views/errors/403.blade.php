@extends('errors.layout')

@section('title', 'Acceso denegado')
@section('code', '403')
@section('message', 'No tienes permiso para acceder a esta sección.')

@section('icon')
    <img src="{{ asset('image/403.jpg') }}" alt="Acceso denegado" class="mx-auto mb-6 max-w-xs w-full" />
@endsection
