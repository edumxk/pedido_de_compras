@php
    $isDarkMode = session('dark_mode');
@endphp

@if($isDarkMode == true)
    <!-- Logo com texto branco para o tema dark -->
    <img src="{{ asset('img/logo-dark.svg') }}" width="100"  alt="Logo">
@else
    <!-- Logo com texto preto para o tema normal -->
    <img src="{{ asset('img/logo.svg') }}" width="100" alt="Logo">
@endif
