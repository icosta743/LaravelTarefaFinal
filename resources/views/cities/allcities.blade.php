@extends('layouts.fo')

@section('content')

    <a href="{{ route('countries.all') }}" class="btn btn-secondary btn-sm mt-4">Back</a>

    <h2 class="mt-4 mb-4">{{ $countryInfo->name }}</h2>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @auth
        @if (Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
            <a href="{{ route('cities.add', $countryInfo->id) }}" class="btn btn-olive btn-sm mb-4">Add city</a>
        @endif
    @endauth

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Photo</th>
                <th scope="col">City</th>
                <th scope="col">Local food</th>
                <th scope="col">Visited at</th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($cities as $city)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>
                        @if ($city->photo)
                            <img src="{{ asset('storage/' . $city->photo) }}" alt="" class="country-photo">
                        @endif
                    </td>
                    <td>{{ $city->name }}</td>
                    <td>{{ $city->local_food }}</td>
                    <td>{{ $city->visited_at }}</td>
                    <td>
                        @auth
                            <a href="{{ route('cities.edit', $city->id) }}" class="btn btn-info">Edit</a>
                            @if (Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
                                <a href="{{ route('cities.delete', $city->id) }}" class="btn btn-danger">Delete</a>
                            @endif
                        @endauth
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
