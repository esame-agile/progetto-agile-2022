@extends('layouts/main')
@section('content')
    <div class="container">
        <!--- Copertina del profilo --->
        <div class="card copertina-profilo">
            <div class="profile-background">
                <!--- Immagine di copertina del profilo --->
            </div>
            <div class="profile-picture">
                <!--- Immagine del profilo --->
            </div>
            <div class="nome-utente-container">
                <p class="testo grande">Nome Di Prova{{-- {{$nome}} {{$cognome}} --}}</p>
                <p class="testo">Ambito di ricerca{{-- {{$ambito_ricerca}} --}} <br> {{-- {{$nome_azienda}} --}} romano
                    spa </p>
            </div>
            <div class="contatti">
                <p class="testo">
                    {{--{{$università}}--}}Università degli Studi di Milano
                </p>
                <p class="testo">
                    {{--{{$email}}--}}davide.deacetis13@gmail.com
                </p>
                <p class="testo">
                    {{--{{$telefono}}--}}3279461214
                </p>
            </div>
        </div>

        <!--- Fine copertina del profilo --->

        <button class="mx-3 main-btn gradient-btn">Modifica profilo</button>

        <!--- Pubblicazioni --->

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Pubblicazione
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Progetto
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        Apple MacBook Pro 17"
                    </th>
                    <td class="px-6 py-4">
                        Sliver
                    </td>
                    <td class="px-6 py-4">
                        Laptop
                    </td>
                    <td class="px-6 py-4">
                        $2999
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    </td>
                </tr>
                <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        Microsoft Surface Pro
                    </th>
                    <td class="px-6 py-4">
                        White
                    </td>
                    <td class="px-6 py-4">
                        Laptop PC
                    </td>
                    <td class="px-6 py-4">
                        $1999
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    </td>
                </tr>
                <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        Magic Mouse 2
                    </th>
                    <td class="px-6 py-4">
                        Black
                    </td>
                    <td class="px-6 py-4">
                        Accessories
                    </td>
                    <td class="px-6 py-4">
                        $99
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    </td>
                </tr>
                <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        Google Pixel Phone
                    </th>
                    <td class="px-6 py-4">
                        Gray
                    </td>
                    <td class="px-6 py-4">
                        Phone
                    </td>
                    <td class="px-6 py-4">
                        $799
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    </td>
                </tr>
                <tr class="odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        Apple Watch 5
                    </th>
                    <td class="px-6 py-4">
                        Red
                    </td>
                    <td class="px-6 py-4">
                        Wearables
                    </td>
                    <td class="px-6 py-4">
                        $999
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <!--- Fine pubblicazioni --->
    </div>

    <style>
        .titolo {
            margin: 2% 2% 2% 2%;
        }

        .nome-utente-container {
            display: inline-block;
            position: absolute;
            margin-left: 1%;
        }

        .card {
            background-color: #e7e9eb;
            border-radius: 15px;
        }

        .copertina-profilo {
            margin: 120px 0 2% 0;
            min-width: 100%;
            min-height: 400px;
            width: 100%;
        }

        .profile-background {
            min-height: 270px;
            background-color: #5b5b5b;
            width: 96%;
            height: 25%;
            margin: 2% 2% 1% 2%;
            border-radius: 15px;
            display: inline-block;
        }

        .profile-picture {
            background-color: #5b5b5b;
            border-radius: 50%;
            width: 150px;
            height: 150px;
            display: inline-block;
            margin: -75px 0 0 5%;
            border-color: #e7e9eb;
            border-width: 5px;
        }

        .card.contatti {
            margin: 2% 0 2% 0;
            width: 100%;
            display: inline-block;
            height: 100%;
        }

        .testo {
            font-weight: 600;
            --text-opacity: 1;
            color: #1a202c;
            color: rgba(26, 32, 44, var(--text-opacity));
            font-family: 'Poppins', sans-serif;
            line-height: 24px;
        }

        .testo.grande {
            display: block;
            position: relative;
            font-size: 24px;
        }

        .testo.contatti {
            display: inline-block;
            margin: 2% 0 0 2%;
            font-size: 24px;
        }

        .contatti {
            display: block;
            float: right;
            margin-right: 3%;
            text-align: right;
        }

        .mx-3.main-btn.gradient-btn {
            display: inline-block;
            margin: 1% auto;
        }
    </style>
@endsection
