@extends('layouts.main')
@section('content')
    <div class="container mx-auto">
        <!--- Copertina del profilo --->
        <x-profile>
            <x-slot name="nome">
                {{$manager->nome}} {{$manager->cognome}}
                @auth()
                    {{-- Pulsante per editare informazioni personali --}}
                    <a href="{{route('manager.edit', $manager)}}"><i
                            class="lni lni-pencil"></i></a>
                @endauth
            </x-slot>
            <x-slot name="info">

            </x-slot>
            <x-slot name="profile_picture">
                <div class="profile-picture">
                    <!--- Immagine del profilo --->
                </div>
            </x-slot>
            <x-slot name="contatti">
                <x-li>
                    <span class="font-bold">Contatti:</span> <br>
                    {{$manager->email}}
                </x-li>
            </x-slot>
            <!--- Fine copertina del profilo --->
        </x-profile>
    </div>
@endsection
