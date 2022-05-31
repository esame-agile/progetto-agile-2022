@yield('alert-message')
<div class="card-grey mb-10">
    <div class="flex flex-wrap justify-center mb-2">
        <h2 class="text-2xl font-bold leading-normal text-blueGray-700">
            {{$nome}}
        </h2>
    </div>
    <div class="flex flex-wrap justify-between">
        <div class="card-white profile-info">
            <ul class="list-none">
                {{$info}}
            </ul>
        </div>
        {{$profile_picture}}
        <div class="card-white profile-info">
            <ul class="list-none">
                {{$contatti}}
            </ul>
        </div>
    </div>
</div>
@if(isset($progetti) && isset($pubblicazioni))
    <div class="flex-wrap flex justify-between">
        <div class="lg:w-6/12 pr-5 respTable">
            {{$pubblicazioni}}
        </div>
        <div class="lg:w-6/12 pl-5 respTable">
            {{$progetti}}
        </div>
    </div>
@elseif(isset($pubblicazioni))
    {{$pubblicazioni}}
@elseif(isset($progetti))
    {{$progetti}}
@endif


