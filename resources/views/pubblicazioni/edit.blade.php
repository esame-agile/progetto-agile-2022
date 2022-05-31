@extends('layouts/main')
@include('layouts.alert-message')
@section('content')

    <div id="home" class="relative z-10 header-hero">
        <div class="container">
            <div class="justify-center row">
                <div class="w-full lg:w-5/6 xl:w-2/3">
                    <div class="pt-5 pb-64 header-content">  <!-- pt padding top -->

                    <form class="" id="modificaP" method="POST" action="{{ route('pubblicazioni.update',$progetto) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-6">
                            <div class="flex justify-around">
                                <div class="flex justify-center">
                                    <label><strong>Rendi visibili le pubblicazioni nascoste :</strong></label>
                                    <div class="form-check">
                                        @if($pubblicazioniF!=null)
                                            @foreach($pubblicazioniF as $pubblicazioneF)
                                                <br> <label><input type="checkbox" name="pubblicazioniF[]" value="{{$pubblicazioneF->id}}"> {{$pubblicazioneF->titolo}} </label>

                                            @endforeach
                                        @else
                                            <label><strong>Nessuna pubblicazione nascosta</strong></label>
                                        @endif
                                    </div>
                                    <div class="flex justify-center">
                                        <label><strong>Nascondi le pubblicazioni visibili :</strong></label>
                                        <div class="form-check">
                                            @if($pubblicazioniT!=null)
                                                @foreach($pubblicazioniT as $pubblicazioneT)
                                                    <br> <label><input type="checkbox" name="pubblicazioniT[]" value="{{$pubblicazioneT->id}}"> {{$pubblicazioneT->titolo}} </label>

                                                @endforeach
                                            @else
                                                <label><strong>Nessuna pubblicazione visibile </strong></label>
                                            @endif
                                        </div>
                                    </div>


                                </div>
                            </div>
                            </div>
                    </form>
                        </div>

                    </div>
                <div class="pt-10 flex items-center justify-center">
                    <x-button type="submit" form="modificaP"> SALVA LE MODIFICHE </x-button>
                </div>
                        </div>
        </div><!-- header content -->




@endsection
