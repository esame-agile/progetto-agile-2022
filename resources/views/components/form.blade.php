
<h2 class="text-2xl font-bold leading-normal text-blueGray-700 mb-2 ml-5 uppercase">
    {{$title}}
</h2>
@yield('alert-message')
<div class="card-grey mb-10">
    {{$form}}
    @if(isset($pulsanti))
        {{$pulsanti}}
    @endif
</div>




