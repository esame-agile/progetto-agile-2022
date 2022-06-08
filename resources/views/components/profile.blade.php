@yield('alert-message')
<div class="card-grey mb-10">
    <div class=" ">
        <div class="card-white profile-info w-full px-4 py-4">
            <h2 class="text-2xl font-bold leading-normal text-blueGray-700">
                {{$nome}}
            </h2>
            <ul class="list-none">
                {{$info}}
                {{$contatti}}
            </ul>
        </div>
    </div>
</div>
@if(isset($progetti) && isset($pubblicazioni))

    {{$pubblicazioni}}
    {{$progetti}}

@elseif(isset($pubblicazioni))
    {{$pubblicazioni}}
@elseif(isset($progetti))
    {{$progetti}}
@endif
