@extends('layouts.fo')

@section('content')

    <button onclick="history.back()" class="btn btn-secondary mt-4">Back</button>

    <h1 class="mt-3">Add city to {{ $countryInfo->name }}</h1>

    <form method="POST" action="{{ route('cities.store') }}" enctype="multipart/form-data">
        @csrf

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
