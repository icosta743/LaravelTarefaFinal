@extends('layouts.fo')

@section('content')

    <button onclick="history.back()" class="btn btn-secondary btn-sm mt-4">Back</button>

    <h2 class="mt-4 mb-3">Edit {{ $cityInfo->name }}</h2>

    @if ($cityInfo->photo)
        <img src="{{ asset('storage/' . $cityInfo->photo) }}" alt="" class="country-photo mb-3">
    @endif

    <form method="POST" action="{{ route('cities.update') }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <input type="hidden" name="id" value="{{ $cityInfo->id }}">
        <input type="hidden" name="country_id" value="{{ $cityInfo->country_id }}">
        <input type="hidden" name="current_photo" value="{{ $cityInfo->photo }}">

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

        <div class="mb-3">
            <label class="form-label">Dish photo</label>
            <input type="file" name="photo" accept="image/*" class="form-control">
        </div>
        @error('photo')
            <p>Invalid photo</p>
        @enderror

        <button type="submit" class="btn btn-olive">Update</button>
    </form>

@endsection
