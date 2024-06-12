@extends('layouts.app')

@section('title', 'SVM')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/upload.css') }}">
    <style>
        .custom-background {
            background-color: #330c08;
        }
    </style>
@endsection

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center text-white" style="height: 80vh;">
        <h1>Insira o arquivo para ser classificado pelo algoritmo SVM:</h1>
        <form id="uploadForm" action="{{ route('svm.upload') }}" method="POST" enctype="multipart/form-data" class="mt-4">
            @csrf
            <div class="d-flex flex-column align-items-center">
                <label for="fileInput" class="input-file-label">Escolha o arquivo</label>
                <input type="file" name="file" id="fileInput" class="input-file" required>
                <span class="file-name" id="fileName"></span>
                <button type="submit" class="btn btn-custom mt-2">Enviar</button>
            </div>
        </form>
        <div id="loadingOverlay" class="loading-overlay d-none">
            <div class="spinner-border text-light" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        @error('file')
        <div class="alert alert-danger mt-3">
            {{ $message }}
        </div>
        @enderror
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('fileInput').addEventListener('change', function() {
            var fileName = document.getElementById('fileInput').files[0].name;
            document.getElementById('fileName').textContent = fileName;
        });

        document.getElementById('uploadForm').addEventListener('submit', function() {
            document.getElementById('loadingOverlay').classList.remove('d-none');
        });
    </script>
@endsection
