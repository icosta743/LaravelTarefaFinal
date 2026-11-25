{{-- usa o layout master (menu, css e bootstrap) --}}
@extends('layouts.fo')

{{-- este conteúdo entra no @yield('content') do layout --}}
@section('content')

    {{-- voltar à lista de países --}}
    <a href="{{ route('countries.all') }}" class="btn btn-secondary btn-sm mt-4">Back</a>

    <h3 class="mt-3">Add country</h3>

    {{-- formulário que envia os dados para a rota countries.store (função storeCountry) --}}
    {{-- POST: os dados vão escondidos no pedido --}}
    {{-- enctype: necessário para enviar ficheiros --}}
    <form method="POST" action="{{ route('countries.store') }}" enctype="multipart/form-data">
        {{-- proteção obrigatória dos formulários (sem ela dá erro 419) --}}
        @csrf

        {{-- nome do país (o name="name" é o $request->name no controller) --}}
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input required type="text" name="name" class="form-control">
        </div>
        {{-- mensagem de erro se a validação do nome falhar --}}
        @error('name')
            <p>Invalid name</p>
        @enderror

        {{-- foto do país, só aceita imagens (o name="photo" é o $request->photo no controller) --}}
        <div class="mb-3">
            <label class="form-label">Photo</label>
            <input type="file" name="photo" accept="image/*" class="form-control">
        </div>
        {{-- mensagem de erro se a validação da foto falhar --}}
        @error('photo')
            <p>Invalid photo</p>
        @enderror

        {{-- envia o formulário --}}
        <button type="submit" class="btn btn-olive">Save</button>
    </form>

@endsection
