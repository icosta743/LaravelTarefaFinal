@extends('layouts.fo')

@section('content')
    <h2 class="mt-5 mb-4">Login</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input required type="email" name="email" class="form-control" id="exampleInputEmail1">
        </div>
        @error('email')
            <p>Invalid email</p>
        @enderror

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input required type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        @error('password')
            <p>Invalid password</p>
        @enderror

        <button type="submit" class="btn btn-olive">Login</button>
        <p class="mt-3">Don't have an account? <a href="{{ route('register') }}">Register</a></p>

    </form>
@endsection
