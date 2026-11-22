@extends('layouts.fo')

@section('content')

    <h3 class="mt-5 mb-4">Trash</h3>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <h5 class="mb-3">Countries</h5>

    <table class="table mb-5">
        <thead>
            <tr>
                <th scope="col">Photo</th>
                <th scope="col">Country</th>
                <th scope="col">Deleted at</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($countries as $country)
                <tr>
                    <td>
                        @if ($country->photo)
                            <img src="{{ asset('storage/' . $country->photo) }}" alt="" class="country-photo">
                        @endif
                    </td>
                    <td>{{ $country->name }}</td>
                    <td>{{ $country->deleted_at }}</td>
                    <td>
                        <a href="{{ route('countries.restore', $country->id) }}" class="btn btn-olive">Restore</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h5 class="mb-3">Cities</h5>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Photo</th>
                <th scope="col">City</th>
                <th scope="col">Country</th>
                <th scope="col">Deleted at</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cities as $city)
                <tr>
                    <td>
                        @if ($city->photo)
                            <img src="{{ asset('storage/' . $city->photo) }}" alt="" class="country-photo">
                        @endif
                    </td>
                    <td>{{ $city->name }}</td>
                    <td>{{ $city->country_name }}</td>
                    <td>{{ $city->deleted_at }}</td>
                    <td>
                        <a href="{{ route('cities.restore', $city->id) }}" class="btn btn-olive">Restore</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
