@extends('layouts.main')
@include('layouts.alert-message')
@section('content')
    <div class="container mx-auto">
        <!--- Copertina del profilo --->
        <div class="card copertina-profilo">
            @yield('alert-message')
            <div class="card-body">
                <div class="profile-background">
                    <!--- Immagine di copertina del profilo --->
                </div>
                <div class="profile-picture">
                    <!--- Immagine del profilo --->
                </div>
                <div class="nome-utente-container">
                    <p class="testo grande">{{$manager->nome}} {{$manager->cognome}} </p>

                    <p class="testo">
                        {{$manager->ruolo}}
                    </p>

                </div>
                <div class="contatti">
                    <p class="testo">
                        {{$manager->email}}
                    </p>
                </div>
            </div>
            @auth()
                {{-- Pulsante per editare informazioni personali --}}
                <a href="{{route('manager.edit', $manager)}}"><i
                        class="lni lni-pencil edit"></i></a>
            @endauth
            <div class="contatti hidden">
                <p class="testo">
                    {{$manager->email}}
                </p>
            </div>
        </div>
        <!--- Fine copertina del profilo --->
    </div>
@endsection
