{{-- usa o layout master (menu, css e bootstrap) --}}
@extends('layouts.fo')

{{-- este conteúdo entra no @yield('content') do layout --}}
@section('content')

    {{-- voltar às cidades do país --}}
    <a href="{{ route('cities.country', $countryInfo->id) }}" class="btn btn-secondary btn-sm mt-4">Back</a>

    {{-- nome do país onde vou adicionar a cidade (vem do controller: $countryInfo) --}}
    <h3 class="mt-3">Add city to {{ $countryInfo->name }}</h3>

    {{-- formulário que envia os dados para a rota cities.store (função storeCity) --}}
    {{-- POST: os dados vão escondidos no pedido --}}
    {{-- enctype: necessário para enviar ficheiros --}}
    <form method="POST" action="{{ route('cities.store') }}" enctype="multipart/form-data">
        {{-- proteção obrigatória dos formulários (sem ela dá erro 419) --}}
        @csrf

        {{-- id do país, escondido, para ligar a cidade ao país (chega ao controller como $request->country_id) --}}
        <input type="hidden" name="country_id" value="{{ $countryInfo->id }}">

        {{-- nome da cidade (obrigatório) --}}
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input required type="text" name="name" class="form-control">
        </div>
        {{-- mensagem de erro se a validação falhar --}}
        @error('name')
            <p>Invalid name</p>
        @enderror

        {{-- comida típica da cidade --}}
        <div class="mb-3">
            <label class="form-label">Local food</label>
            <input type="text" name="local_food" class="form-control">
        </div>
        @error('local_food')
            <p>Invalid local food</p>
        @enderror

        {{-- data da visita (type="date" abre um calendário) --}}
        <div class="mb-3">
            <label class="form-label">Visited at</label>
            <input type="date" name="visited_at" class="form-control">
        </div>
        @error('visited_at')
            <p>Invalid date</p>
        @enderror

        {{-- foto da comida, só aceita imagens --}}
        <div class="mb-3">
            <label class="form-label">Photo</label>
            <input type="file" name="photo" accept="image/*" class="form-control">
        </div>
        @error('photo')
            <p>Invalid photo</p>
        @enderror

        {{-- envia o formulário --}}
        <button type="submit" class="btn btn-olive">Save</button>
    </form>

@endsection
