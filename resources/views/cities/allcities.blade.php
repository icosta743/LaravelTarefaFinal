@extends('layouts.fo')

@section('content')

    <h3 class="mt-5 mb-4">{{ $countryInfo->name }}</h3>

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
                            <a href="{{ route('cities.edit', $city->id) }}" class="btn btn-info btn-sm">Edit</a>
                            @if (Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
                                <a href="{{ route('cities.delete', $city->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete {{ $city->name }}?')">Delete</a>
                            @endif
                        @endauth
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('countries.all') }}" class="btn btn-secondary btn-sm mt-3 mb-5">Back</a>

@endsection
