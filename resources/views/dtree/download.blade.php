@extends('layouts.app')

@section('title', 'Baixar Arquivo Processado')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/download.css') }}">
    <style>
        .custom-background {
            background-color: #000000;
        }
    </style>
@endsection

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center text-white" style="height: 80vh;">
        <h1>Arquivo processado pelo algoritmo de árvore de decisão</h1>
        <a href="{{ route('download', ['filename' => $filename]) }}" class="btn btn-custom mt-3">Baixar Arquivo Processado</a>
    </div>
@endsection
