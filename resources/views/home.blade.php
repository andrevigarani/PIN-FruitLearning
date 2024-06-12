@extends('layouts.app')

@section('title', 'Home')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
    <div class="text-light" style="height: 80vh;">
        <div style="position: relative; top: 50%; transform: translateY(-50%); width: 50%">
            <h1 class="fw-bold">Conheça suas Frutas</h1>
            <p class="lead">Com base no aprendizado de máquina, utilizamos algoritmos de classificação para que você descubra que frutas seu arquivo de dados possui.</p>
            <div class="mt-4">
                <a href="{{ route('svm') }}" class="btn btn-custom btn-md mr-2">Classifique via SVM</a>
                <a href="{{ route('decision-tree') }}" class="btn btn-custom-secondary btn-md">Classifique via Decision Tree</a>
            </div>
        </div>
    </div>
@endsection
