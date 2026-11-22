@extends('layouts.fo')

@section('content')

    {{-- voltar à lista de países --}}
    <a href="{{ route('countries.all') }}" class="btn btn-secondary btn-sm mt-4">Back</a>

    <h3 class="mt-3">Add country</h3>

    {{-- enctype: necessário para enviar ficheiros --}}
    <form method="POST" action="{{ route('countries.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input required type="text" name="name" class="form-control">
        </div>
        @error('name')
            <p>Invalid name</p>
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
