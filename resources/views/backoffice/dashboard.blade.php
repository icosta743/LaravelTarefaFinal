{{-- usa o layout master (menu, css e bootstrap) --}}
@extends('layouts.fo')

{{-- este conteúdo entra no @yield('content') do layout --}}
@section('content')

    {{-- página só para quem tem login (a rota tem ->middleware('auth')) --}}
    <h3 class="mt-5 mb-3">Dashboard</h3>

    {{-- nome do utilizador com login (Auth::user() dá os dados de quem tem login) --}}
    <h5 class="mb-4">Olá, {{ Auth::user()->name }}</h5>

    {{-- botão da lixeira, só para o admin (user_type = 1) --}}
    {{-- aqui não é preciso @auth, porque só chega a esta página quem tem login --}}
    @if (Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
        <a href="{{ route('trash.all') }}" class="btn btn-olive btn-sm">🗑️ Trash</a>
    @endif

@endsection
