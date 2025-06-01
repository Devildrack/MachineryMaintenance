@extends('errors.layout')

@section('title', 'Página no encontrada')
@section('code', '404')
@section('message', 'La página que estás buscando no existe o fue movida.')

@section('icon')
    <img src="{{ asset('image/404.jpg') }}" alt="Pagina no encontrada" class="mx-auto mb-6 max-w-xs w-full" />
@endsection
