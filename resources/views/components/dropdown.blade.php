@props(['disabled' => false])


<button id="dropdownDefault" data-dropdown-toggle="dropdown" data-dropdown-placement="top"
    {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500 h-10']) !!}
    type="button"> {{$label}} <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
    <!-- Dropdown menu -->
<div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-96 dark:bg-gray-700">
    <ul class="scroll-py-1 text-sm text-gray-700 dark:text-gray-200 max-h-48 overflow-y-scroll" aria-labelledby="dropdownDefault">
            {{$content}}
    </ul>
</div>
