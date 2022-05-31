<div class="flex flex-wrap justify-between">
    <h2 class="text-3xl font-bold leading-normal text-blueGray-700 mb-2 ml-5 uppercase">
        {{ $titolo }}
    </h2>
    @yield('alert-message')
    @if(isset($pulsanti_up))
        <div class="pr-5 pb-5">
            {{$pulsanti_up}}
        </div>
    @endif
</div>
<div class="card-grey mb-10">
    {{$link}}
    <div class="overflow-hidden rounded-lg shadow-lg">
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
    @if(isset($pulsanti))
        {{$pulsanti}}
    @endif
</div>

