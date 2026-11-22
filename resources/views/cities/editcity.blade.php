@extends('layouts.fo')

@section('content')

    {{-- voltar às cidades do país --}}
    <a href="{{ route('cities.country', $cityInfo->country_id) }}" class="btn btn-secondary btn-sm mt-4">Back</a>

    <h3 class="mt-4 mb-3">Edit {{ $cityInfo->name }}</h3>

    {{-- foto atual --}}
    @if ($cityInfo->photo)
        <img src="{{ asset('storage/' . $cityInfo->photo) }}" alt="" class="country-photo mb-3">
    @endif

    <form method="POST" action="{{ route('cities.update') }}" enctype="multipart/form-data">
        {{-- o html só tem GET e POST, o @method transforma em PUT --}}
        @method('PUT')
        @csrf

        {{-- dados escondidos: id da cidade, país e foto atual --}}
        <input type="hidden" name="id" value="{{ $cityInfo->id }}">
        <input type="hidden" name="country_id" value="{{ $cityInfo->country_id }}">
        <input type="hidden" name="current_photo" value="{{ $cityInfo->photo }}">

        {{-- campos preenchidos com os dados atuais --}}
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input value="{{ $cityInfo->name }}" required type="text" name="name" class="form-control">
        </div>
        @error('name')
            <p>Invalid name</p>
        @enderror

        <div class="mb-3">
            <label class="form-label">Local food</label>
            <input value="{{ $cityInfo->local_food }}" type="text" name="local_food" class="form-control">
        </div>
        @error('local_food')
            <p>Invalid local food</p>
        @enderror

        <div class="mb-3">
            <label class="form-label">Visited at</label>
            <input value="{{ $cityInfo->visited_at }}" type="date" name="visited_at" class="form-control">
        </div>
        @error('visited_at')
            <p>Invalid date</p>
        @enderror

        {{-- se não escolher foto nova, fica a atual --}}
        <div class="mb-3">
            <label class="form-label">Photo</label>
            <input type="file" name="photo" accept="image/*" class="form-control">
        </div>
        @error('photo')
            <p>Invalid photo</p>
        @enderror

        <button type="submit" class="btn btn-olive">Update</button>
    </form>

@endsection
