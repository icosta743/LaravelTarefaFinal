@extends('layouts.fo')

@section('content')

    <h3 class="mt-5 mb-3">Dashboard</h3>

    {{-- nome do utilizador com login --}}
    <h5 class="mb-4">Olá, {{ Auth::user()->name }}</h5>

    {{-- botão da lixeira, só para o admin --}}
    @if (Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
        <a href="{{ route('trash.all') }}" class="btn btn-olive btn-sm">🗑️ Trash</a>
    @endif

@endsection
