{{-- usa o layout master (menu, css e bootstrap) --}}
@extends('layouts.fo')

{{-- este conteúdo entra no @yield('content') do layout --}}
@section('content')

    {{-- nome do país (vem do controller: $countryInfo) --}}
    <h3 class="mt-5 mb-4">{{ $countryInfo->name }}</h3>

    {{-- mensagem de sucesso depois de adicionar ou editar (vem do with('message') do controller) --}}
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    {{-- botão de adicionar, só para o admin --}}
    {{-- envia o id do país, para a cidade nova ficar ligada a ele --}}
    @auth
        @if (Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
            <a href="{{ route('cities.add', $countryInfo->id) }}" class="btn btn-olive btn-sm mb-4">Add city</a>
        @endif
    @endauth

    {{-- tabela das cidades (bootstrap) --}}
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Photo</th>
                <th scope="col">City</th>
                <th scope="col">Local food</th>
                <th scope="col">Visited at</th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody>
            {{-- percorre as cidades do país que vêm do controller (compact('cities')) --}}
            @foreach ($cities as $city)
                <tr>
                    {{-- numeração 1, 2, 3... (os ids podem ter saltos) --}}
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>
                        {{-- mostra a foto da comida só se existir --}}
                        @if ($city->photo)
                            <img src="{{ asset('storage/' . $city->photo) }}" alt="" class="country-photo">
                        @endif
                    </td>
                    <td>{{ $city->name }}</td>
                    <td>{{ $city->local_food }}</td>
                    <td>{{ $city->visited_at }}</td>
                    <td>
                        {{-- editar: qualquer utilizador com login --}}
                        @auth
                            <a href="{{ route('cities.edit', $city->id) }}" class="btn btn-info btn-sm">Edit</a>
                            {{-- apagar: só o admin, com confirmação (OK apaga, Cancelar não faz nada) --}}
                            @if (Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
                                <a href="{{ route('cities.delete', $city->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete {{ $city->name }}?')">Delete</a>
                            @endif
                        @endauth
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- voltar à lista de países --}}
    <a href="{{ route('countries.all') }}" class="btn btn-secondary btn-sm mt-3 mb-5">Back</a>

@endsection
