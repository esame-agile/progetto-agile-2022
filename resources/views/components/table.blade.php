<div class="flex flex-wrap justify-between">
    @if(isset($titolo))
        <h2 class="text-3xl font-bold leading-normal text-blueGray-700 mb-2 ml-5 uppercase">
            {{ $titolo }}
        </h2>
    @endif
    @yield('alert-message')
    @if(isset($pulsanti_up))
        <div class="pr-5 pb-5">
            {{$pulsanti_up}}
        </div>
    @endif
</div>
<div class="card-grey mb-10">
    @if(isset($titolo_interno))
        <h2 class="text-3xl font-bold leading-normal text-blueGray-700 mb-2 ml-5 uppercase">
            {{ $titolo_interno }}
        </h2>
    @endif
    @if(isset($pulsanti_up_interno))
        <div class="ml-5 pr-5 pb-5">
            {{$pulsanti_up_interno}}
        </div>
    @endif
    {{$link}}
    <div class="overflow-x-auto rounded-lg shadow-lg">
        <table class="w-full">
            <thead>
            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                {{ $colonne }}
            </tr>
            </thead>
            <tbody class="bg-white">
            {{ $righe }}
            </tbody>
        </table>
    </div>
    <div class="pr-5 pb-5">
        @if(isset($pulsanti))
            {{$pulsanti}}
        @endif
    </div>
</div>

