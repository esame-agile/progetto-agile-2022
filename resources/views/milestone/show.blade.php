@extends('layouts.main')
@section('content')
    <div class=" container mx-auto">
        @yield('alert-message')
        <h2 class=" testo titolo grande">Milestone: </h2>
        <div class=" card ">
            <p class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Descrizione della milestone:</p> {{ $milestone->descrizione }}
            <br>
            <p class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Data dell'evento:</p> {{ $milestone->data_evento }}
        </div>

    </div>
@endsection
