@extends('layouts.fo')

@section('content')

    {{-- página da lixeira (extra: soft deletes), aberta pelo botão Trash do dashboard --}}
    <h3 class="mt-5 mb-4">Trash</h3>

    {{-- mensagem de sucesso depois de restaurar --}}
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    {{-- tabela dos países apagados (deleted_at preenchido) --}}
    <h5 class="mb-3">Countries</h5>

    <table class="table mb-5">
        <thead>
            <tr>
                <th scope="col">Photo</th>
                <th scope="col">Country</th>
                <th scope="col">Deleted at</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            {{-- percorre os países que vêm do onlyTrashed() --}}
            @foreach ($countries as $country)
                <tr>
                    <td>
                        {{-- mostra a foto só se existir --}}
                        @if ($country->photo)
                            <img src="{{ asset('storage/' . $country->photo) }}" alt="" class="country-photo">
                        @endif
                    </td>
                    <td>{{ $country->name }}</td>
                    {{-- data em que foi apagado --}}
                    <td>{{ $country->deleted_at }}</td>
                    <td>
                        {{-- restaura o país e as suas cidades --}}
                        <a href="{{ route('countries.restore', $country->id) }}" class="btn btn-olive btn-sm">Restore</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- tabela das cidades apagadas (só de países que não estão na lixeira) --}}
    <h5 class="mb-3">Cities</h5>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Photo</th>
                <th scope="col">City</th>
                <th scope="col">Country</th>
                <th scope="col">Deleted at</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            {{-- percorre as cidades que vêm do onlyTrashed() --}}
            @foreach ($cities as $city)
                <tr>
                    <td>
                        {{-- mostra a foto só se existir --}}
                        @if ($city->photo)
                            <img src="{{ asset('storage/' . $city->photo) }}" alt="" class="country-photo">
                        @endif
                    </td>
                    <td>{{ $city->name }}</td>
                    {{-- nome do país, vem do join no controller --}}
                    <td>{{ $city->country_name }}</td>
                    {{-- data em que foi apagada --}}
                    <td>{{ $city->deleted_at }}</td>
                    <td>
                        {{-- restaura só esta cidade --}}
                        <a href="{{ route('cities.restore', $city->id) }}" class="btn btn-olive btn-sm">Restore</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- voltar ao dashboard --}}
    <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm mt-3 mb-5">Back</a>

@endsection
