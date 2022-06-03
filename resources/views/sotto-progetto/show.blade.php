@extends('layouts.main')
@section('content')
    <div class="container mx-auto">
        <!-----Descrizione----->
        <div class="flex flex-wrap justify-center">
            <div class="card-grey lg:w-1/2  mb-10">
                <div class="card-white px-5 py-5">
                    <h3 class="text-4xl font-semibold leading-normal text-blueGray-700 uppercase">
                        {{$sottoProgetto->titolo}}
                    </h3>
                    @auth
                        @if(Auth::user()->ruolo == "manager")
                            <div class="flex flex-wrap">
                                <a href="{{ route('sotto-progetto.edit', $sottoProgetto) }}"><i
                                        class="lni lni-pencil px-12"></i></a>
                                <form method="POST"
                                      action="{{ route('sotto-progetto.destroy', $sottoProgetto) }}"
                                      id="delete_progetto"
                                      name="delete_progetto"
                                      onsubmit="confirm('Sei sicuro di voler cancellare?')">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit"><i class="lni lni-trash"></i></button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
                <div class="card-white mt-5 px-5 py-5">
                    <div class="text-sm leading-normal text-blueGray-700 font-bold uppercase">
                        DESCRIZIONE:
                    </div>
                    <div class="text-blueGray-700">
                        {{$sottoProgetto->descrizione}}
                    </div>
                    <div class="text-sm leading-normal text-blueGray-700 font-bold uppercase">
                        DATA DI RILASCIO PREVISTA:
                    </div>
                    <div class="text-blueGray-700">
                        {{$sottoProgetto->data_rilascio}}
                    </div>
                    <div class="text-sm leading-normal text-blueGray-700 font-bold uppercase">
                        RESPONSABILE:
                    </div>
                    <div class="text-blueGray-700">
                        {{$sottoProgetto->responsabile->nome . " " . $sottoProgetto->responsabile->cognome}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
