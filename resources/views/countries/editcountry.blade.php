@extends('layouts.fo')

@section('content')

    <a href="{{ route('countries.all') }}" class="btn btn-secondary btn-sm mt-4">Back</a>

    <h3 class="mt-3">Edit {{ $countryInfo->name }}</h3>
    
    @if ($countryInfo->photo)
        <img src="{{ asset('storage/' . $countryInfo->photo) }}" alt="" class="country-photo mb-3">
    @endif

    <form method="POST" action="{{ route('countries.update') }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <input type="hidden" name="id" value="{{ $countryInfo->id }}">
        <input type="hidden" name="current_photo" value="{{ $countryInfo->photo }}">

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input value="{{ $countryInfo->name }}" required type="text" name="name" class="form-control">
        </div>
        @error('name')
            <p>Invalid name</p>
        @enderror

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
