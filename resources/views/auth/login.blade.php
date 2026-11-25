{{-- usa o layout master (menu, css e bootstrap) --}}
@extends('layouts.fo')

{{-- este conteúdo entra no @yield('content') do layout --}}
@section('content')
    <h3 class="mt-5 mb-4">Login</h3>

    {{-- formulário de login (tratado pelo Fortify) --}}
    {{-- a rota login é criada pelo Fortify, não está no web.php --}}
    <form method="POST" action="{{ route('login') }}">
        {{-- proteção obrigatória dos formulários (sem ela dá erro 419) --}}
        @csrf

        {{-- email (type="email" obriga a ter formato de email) --}}
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input required type="email" name="email" class="form-control" id="exampleInputEmail1">
        </div>
        {{-- mensagem de erro se o email ou a password estiverem errados --}}
        @error('email')
            <p>Invalid email</p>
        @enderror

        {{-- password (type="password" esconde o que se escreve) --}}
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input required type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        @error('password')
            <p>Invalid password</p>
        @enderror

        {{-- envia o formulário; se estiver certo, o Fortify manda para o /dashboard --}}
        <button type="submit" class="btn btn-olive">Login</button>

        {{-- link para a página de registo --}}
        <p class="mt-3">Don't have an account? <a href="{{ route('register') }}">Register</a></p>

    </form>
@endsection
