{{-- usa o layout master (menu, css e bootstrap) --}}
@extends('layouts.fo')

{{-- este conteúdo entra no @yield('content') do layout --}}
@section('content')

    {{-- frase de entrada, centrada no ecrã --}}
    <div class="text-center mt-5 pt-5">

        <h2 class="mt-5">Discover more than just places.</h2>

        {{-- classe signature vem do style.css --}}
        <p class="signature">by Isabella</p>

    </div>

@endsection
