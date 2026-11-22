@extends('layouts.fo')

@section('content')

    <h2 class="mt-5 mb-3">Dashboard</h2>

    <h5>Olá, {{ Auth::user()->name }}</h5>

@endsection
