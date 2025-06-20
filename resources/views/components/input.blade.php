@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full bg-gray-800 text-gray-100 rounded-lg p-2 border-transparent border-yellow-100 focus:border-yellow-400 focus:ring focus:ring-yellow-300 focus:ring-opacity-50']) !!}>
