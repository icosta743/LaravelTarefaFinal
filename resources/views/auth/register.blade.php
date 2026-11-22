@extends('layouts.fo')

@section('content')
    <h3 class="mt-5 mb-4">Register</h3>

    {{-- formulário de registo (tratado pelo Fortify) --}}
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input required type="text" name="name" class="form-control">
        </div>
        @error('name')
            <p>Invalid name</p>
        @enderror

        <div class="mb-3">
            <label class="form-label">Email address</label>
            <input required type="email" name="email" class="form-control">
        </div>
        @error('email')
            <p>Invalid email</p>
        @enderror

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input required type="password" name="password" class="form-control">
        </div>
        @error('password')
            <p>Invalid password</p>
        @enderror

        {{-- tem de ser igual à password (regra confirmed) --}}
        <div class="mb-3">
            <label class="form-label">Confirm password</label>
            <input required type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-olive">Register</button>
    </form>
@endsection
