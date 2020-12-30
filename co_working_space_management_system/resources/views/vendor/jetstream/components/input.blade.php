@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-input rounded-md shadow-sm focus:outline-none focus:ring focus:border-gray-700 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150']) !!}>
