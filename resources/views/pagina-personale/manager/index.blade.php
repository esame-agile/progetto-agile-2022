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
                    <p class="testo grande">{{$utente->nome}} {{$utente->cognome}} </p>

                    <p class="testo">
                        {{$utente->ruolo}}
                    </p>

                </div>
                <div class="contatti">
                    <p class="testo">
                        {{$utente->email}}
                    </p>
                </div>
            </div>
            @auth()
                {{-- Pulsante per editare informazioni personali --}}
                <a href="{{route('pagina-personale.manager.edit-info', $utente)}}"><i
                        class="lni lni-pencil edit"></i></a>
            @endauth
            <div class="contatti hidden">
                <p class="testo">
                    {{$utente->email}}
                </p>
            </div>
        </div>
        <!--- Fine copertina del profilo --->
    </div>
@endsection
