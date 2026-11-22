@extends('layouts.fo')

@section('content')

    <h3 class="mt-5 mb-4">Destinations</h3>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @auth
        @if (Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
            <a href="{{ route('countries.add') }}" class="btn btn-olive btn-sm mb-4">Add country</a>
        @endif
    @endauth

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Photo</th>
                <th scope="col">Country</th>
                <th scope="col">Cities</th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($countries as $country)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>
                        @if ($country->photo)
                            <img src="{{ asset('storage/' . $country->photo) }}" alt="" class="country-photo">
                        @endif
                    </td>
                    <td>{{ $country->name }}</td>
                    <td>{{ $country->cities_count }}</td>
                    <td>
                        <a href="{{ route('cities.country', $country->id) }}" class="btn btn-olive">View cities</a>
                        @auth
                            <a href="{{ route('countries.edit', $country->id) }}" class="btn btn-info">Edit</a>
                            @if (Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
                                <a href="{{ route('countries.delete', $country->id) }}" class="btn btn-danger" onclick="return confirm
                                ('Are you sure you want to delete {{ $country->name }}?')">Delete</a>
                            @endif
                        @endauth
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
