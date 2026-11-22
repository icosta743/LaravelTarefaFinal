@extends('layouts.fo')

@section('content')

    {{-- voltar às cidades do país --}}
    <a href="{{ route('cities.country', $countryInfo->id) }}" class="btn btn-secondary btn-sm mt-4">Back</a>

    <h3 class="mt-3">Add city to {{ $countryInfo->name }}</h3>

    {{-- enctype necessário para enviar ficheiros --}}
    <form method="POST" action="{{ route('cities.store') }}" enctype="multipart/form-data">
        @csrf

        {{-- id do país, escondido, para ligar a cidade ao país --}}
        <input type="hidden" name="country_id" value="{{ $countryInfo->id }}">

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input required type="text" name="name" class="form-control">
        </div>
        @error('name')
            <p>Invalid name</p>
        @enderror

        <div class="mb-3">
            <label class="form-label">Local food</label>
            <input type="text" name="local_food" class="form-control">
        </div>
        @error('local_food')
            <p>Invalid local food</p>
        @enderror

        <div class="mb-3">
            <label class="form-label">Visited at</label>
            <input type="date" name="visited_at" class="form-control">
        </div>
        @error('visited_at')
            <p>Invalid date</p>
        @enderror

        {{-- só aceita imagens --}}
        <div class="mb-3">
            <label class="form-label">Photo</label>
            <input type="file" name="photo" accept="image/*" class="form-control">
        </div>
        @error('photo')
            <p>Invalid photo</p>
        @enderror

        <button type="submit" class="btn btn-olive">Save</button>
    </form>

@endsection
