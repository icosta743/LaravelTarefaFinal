{{-- usa o layout master (menu, css e bootstrap) --}}
@extends('layouts.fo')

{{-- este conteúdo entra no @yield('content') do layout --}}
@section('content')

    <h3 class="mt-5 mb-4">Destinations</h3>

    {{-- mensagem de sucesso depois de adicionar ou editar (vem do with('message') do controller) --}}
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    {{-- botão de adicionar, só para o admin --}}
    {{-- @auth: só entra quem tem login / @if: só entra se for admin (user_type = 1) --}}
    @auth
        @if (Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
            <a href="{{ route('countries.add') }}" class="btn btn-olive btn-sm mb-4">Add country</a>
        @endif
    @endauth

    {{-- tabela dos países (bootstrap) --}}
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Photo</th>
                <th scope="col">Country</th>
                <th scope="col">Cities</th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody>
            {{-- percorre os países que vêm do controller --}}
            @foreach ($countries as $country)
                <tr>
                    {{-- numeração 1, 2, 3... (os ids podem ter saltos por causa do loop) --}}
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>
                         {{-- asset('storage/...') vai buscar a foto à pasta public/storage --}}
                        @if ($country->photo) {{-- if ($country->photo): só mostra a imagem se o país tiver foto --}}
                            <img src="{{ asset('storage/' . $country->photo) }}" alt="" class="country-photo">
                        @endif
                    </td>
                    <td>{{ $country->name }}</td>
                    {{-- número de cidades, calculado no controller (count + leftJoin) --}}
                    <td>{{ $country->cities_count }}</td>
                    <td>
                        {{-- ver cidades: todos podem (envia o id do país para a rota) --}}
                        <a href="{{ route('cities.country', $country->id) }}" class="btn btn-olive btn-sm">View cities</a>
                        {{-- editar: qualquer utilizador com login --}}
                        @auth
                            <a href="{{ route('countries.edit', $country->id) }}" class="btn btn-info btn-sm">Edit</a>
                            {{-- apagar: só o admin, com confirmação (OK apaga, Cancelar não faz nada) --}}
                            @if (Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
                                <a href="{{ route('countries.delete', $country->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete {{ $country->name }}?')">Delete</a>
                            @endif
                        @endauth
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
