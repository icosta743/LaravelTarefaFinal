@extends('layouts.fo')

@section('content')

    <h3 class="mt-5 mb-4">Destinations</h3>

    {{-- mensagem de sucesso depois de adicionar ou editar --}}
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    {{-- botão de adicionar, só para o admin --}}
    @auth
        @if (Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
            <a href="{{ route('countries.add') }}" class="btn btn-olive btn-sm mb-4">Add country</a>
        @endif
    @endauth

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
            {{-- percorre os países --}}
            @foreach ($countries as $country)
                <tr>
                    {{-- numeração 1, 2, 3... (os ids podem ter saltos) --}}
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>
                        {{-- mostra a foto só se existir --}}
                        @if ($country->photo)
                            <img src="{{ asset('storage/' . $country->photo) }}" alt="" class="country-photo">
                        @endif
                    </td>
                    <td>{{ $country->name }}</td>
                    {{-- número de cidades, calculado no controller --}}
                    <td>{{ $country->cities_count }}</td>
                    <td>
                        {{-- ver cidades: todos podem --}}
                        <a href="{{ route('cities.country', $country->id) }}" class="btn btn-olive btn-sm">View cities</a>
                        {{-- editar: qualquer utilizador com login --}}
                        @auth
                            <a href="{{ route('countries.edit', $country->id) }}" class="btn btn-info btn-sm">Edit</a>
                            {{-- apagar: só o admin, com confirmação --}}
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
