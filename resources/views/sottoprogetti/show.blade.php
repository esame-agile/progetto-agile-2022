@extends('layouts.main')
@section('content')
    <div class="container mx-auto">
        @yield('alert-message')
        <h2 class=" testo titolo grande">Sottoprogetto: </h2>
        <div class="card ">
            <p class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Descrizione del sottoprogetto:</p> {{$sottoprogetti->titolo }}
            <br>
            <p class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Descrizione del sottoprogetto:</p> {{$sottoprogetti->descrizione }}
            <br>
            <p class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Data rilascio:</p> {{ $sottoprogetti->data_rilascio }}
        </div>

    </div>
@endsection
