@extends('layouts.fo')

@section('content')

    {{-- voltar à lista de países --}}
    <a href="{{ route('countries.all') }}" class="btn btn-secondary btn-sm mt-4">Back</a>

    <h3 class="mt-3">Edit {{ $countryInfo->name }}</h3>

    {{-- foto atual --}}
    @if ($countryInfo->photo)
        <img src="{{ asset('storage/' . $countryInfo->photo) }}" alt="" class="country-photo mb-3">
    @endif

    <form method="POST" action="{{ route('countries.update') }}" enctype="multipart/form-data">
        {{-- o html só tem GET e POST, o @method transforma em PUT --}}
        @method('PUT')
        @csrf

        {{-- dados escondidos: id do país e foto atual --}}
        <input type="hidden" name="id" value="{{ $countryInfo->id }}">
        <input type="hidden" name="current_photo" value="{{ $countryInfo->photo }}">

        {{-- campo preenchido com o nome atual --}}
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input value="{{ $countryInfo->name }}" required type="text" name="name" class="form-control">
        </div>
        @error('name')
            <p>Invalid name</p>
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
