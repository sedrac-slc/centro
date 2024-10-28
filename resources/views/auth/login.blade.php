@extends('layouts.template')
@section('css')
    @parent
    <style>
        .back {
            position: absolute;
            top: 1%;
            left: 1%;
        }

        .top-login{
            padding-top: 5rem;
        }

        .back-bg{
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
            height: 100vh;
            width: 50%;
        }
    </style>
@endsection
@section('content')
    <a href="/" class="back text-white h-2">
        <i class="fas fa-arrow-circle-left"></i>
        <span>voltar</span>
    </a>
    <div class="bg-yellow back-bg"></div>
    <section class="m-4 align-item-center top-login">
        <form method="POST" action="{{ route('login') }}" class="bg-white border border-yellow w-75 m-auto rounded p-3">
            <div class="h4 mb-4">Faça o login</div>
            @csrf
            @include('components.message')
            @include('components.errors')
            <div class="form-group mt-4">
                <label for="email">
                    <i class="fas fa-at text-yellow"></i>
                    <span>Digita o seu email:</span>
                </label>
                <input id="email" class="form-control rounded inline mt-1 @error('email') is-invalid @enderror"
                    type="email" name="email" value="{{ old('email') }}" required autofocus />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mt-4">
                <label for="password">
                    <i class="fas fa-lock text-yellow"></i>
                    <span>Digita a sua senha:</span>
                </label>
                <input id="password" class="form-control rounded inline mt-1 @error('password') is-invalid @enderror"
                    type="password" name="password" required />
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mt-4">
                <button class="btn bg-yellow text-white rounded" type="submit">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span>Logar</span>
                </button>
            </div>
            <div class="block mt-3">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600">lembra-se de mí.</span>
                </label>
            </div>
            <div class="flex items-center justify-end mt-2 mb-2">
                @if (Route::has('password.request'))
                    {{-- <a class="text-primary mb-2 t-d-n" href="{{ route('password.request') }}">
                            <i class="fas fa-key"></i>
                            <span class="ml-1">Não lembro da minha senha.</span>
                        </a> --}}
                @endif
            </div>
            <div class="mb-3">
                {{-- <a class="text-info mt-2 t-d-n" href="{{ route('register') }}">
                        <i class="fas fa-file-alt"></i>
                        <span class="ml-1">Criar uma conta.</span>
                    </a> --}}
            </div>
        </form>
    </section>
@endsection
