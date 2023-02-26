@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-violet-900 focus:ring focus:ring-violet-900 focus:ring-opacity-50']) !!}>
