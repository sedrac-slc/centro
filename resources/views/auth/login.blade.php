@extends('layouts.template')
@section('css')
    @parent
    <style>
        .back{
            position: absolute;
            top: 1%;
            left: 1%;
        }
    </style>
@endsection
@section('body','bg-yellow d-flex justify-content-center align-items-center flex-direction-column')
@section('content')
<a href="/" class="back text-white">
    <i class="fas fa-arrow-circle-left"></i>
    <span>voltar</span>
</a>
<section class="m-3 mt-4">
    <div class="row mt-5">
        <div class="col-md-5 d-flex justify-content-center align-items-center flex-direction-column">
            <h2 class="text-white text-center">
                <span class="ml-2">Faça o Login</span>
            </h2>
            <hr class="text-white"/>
            <img src="{{asset('img/to-do-list.png')}}" alt="" width="90%">
        </div>
        <div class="col-md-7">
            <form method="POST" action="{{ route('login') }}" class="bg-white mt-3 m-auto border rounded p-3">
                @csrf
                @include('components.message')
                @include('components.errors')
                <div class="form-group mt-2">
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
        </div>
    </div>
</section>
@endsection
