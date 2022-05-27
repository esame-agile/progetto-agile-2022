@extends('layouts.main')
@include('layouts.alert-message')
@section('content')
    @yield('alert-message')
    <div id="home" class="relative z-10 header-hero">
        <div class="container">
            <div class="justify-center row">
                <div class="w-full lg:w-5/6 xl:w-2/3">
                    <div style='background-color:rgb(255, 255, 255)'>
                        <div class="relative px-4 mx-auto max-w-7xl sm:px-6 lg:px-4 pb-10" style="cursor: auto;">
                            <div class="max-w-lg mx-auto overflow-hidden rounded-lg shadow-lg lg:max-w-none lg:flex">
                                <div class="flex-1 px-6 py-8 bg-white" style="cursor: auto;">
                                    <h3 class="text-2xl font-extrabold text-gray-900 sm:text-3xl" style="cursor: auto;">
                                        @auth
                                            @if(Auth::user()->ruolo == "manager")
                                                <a href="{{ route('sotto-progetto.edit', ["sotto-progetto" => $sottoprogetti]) }}"><i class="lni lni-pencil"></i></a>
                                                <form method="POST"
                                                      action="{{ route('sotto-progetto.destroy', ["sotto-progetto" => $sottoprogetti] ) }}"
                                                      id="delete_progetto"
                                                      name="delete_progetto"
                                                      onsubmit="confirm('Sei sicuro di voler cancellare?')">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" ><i class="lni lni-trash"></i></button>
                                                </form>
                                            @endif
                                        @endauth
                                        {{$sottoprogetti->titolo}}</h3>
                                    <p class="mt-6 text-base text-gray-500">{{$sottoprogetti->descrizione}}</p>
                                    <div class="mt-8">
                                        <div class="flex items-center">
                                            <h4 class="flex-shrink-0 pr-4 text-sm font-semibold tracking-wider text-indigo-600 uppercase bg-white"> Info aggiuntive </h4>
                                            <div class="flex-1 border-t-2 border-gray-200"></div>
                                        </div>
                                        <ul class="mt-8 space-y-5 lg:space-y-0 lg:grid lg:grid-cols-2 lg:gap-x-8 lg:gap-y-5">
                                            <li class="flex items-start lg:col-span-1">
                                                <div class="flex-shrink-0">
                                                    <svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>

                                                <p class="ml-3 text-sm text-gray-700"> <strong> Data Rilascio: </strong> </p>
                                                <p class="ml-3 text-sm text-gray-700">{{$sottoprogetti->data_rilascio}}</p>
                                            </li>
                                            <li class="flex items-start lg:col-span-1">
                                                <div class="flex-shrink-0">
                                                    <svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>

                                                <p class="ml-3 text-sm text-gray-700">Responsabile in carica:</p>
                                                <p class="ml-3 text-sm text-gray-700">{{$sottoprogetti->responsabile->nome . " " . $sottoprogetti->responsabile->cognome}}</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
