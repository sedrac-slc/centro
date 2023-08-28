@extends('layouts.template')
@php
    use App\Utils\UserUtil;
    $isAdministrador = UserUtil::isAdministrador(false);
@endphp
@section('css')
    @parent
    <style>
        .navbar.bg-yellow .nav-link, .navbar.bg-yellow .navbar-brand{
            color: white;
        }
    </style>
@endsection
@section('body', 'bg-light')
@section('content')
    <nav class="navbar navbar-expand-lg bg-yellow mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">CentroSmart</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>Perfil</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa fa-user-circle" aria-hidden="true"></i>
                            <span>Conta</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Nome: {{ short_name(auth()->user()->name) }}</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="position-relative">
                                <div class="dropdown-item float-right">
                                    <form class="" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-none text-danger rounded">
                                            <i class="fas fa-power-off"></i>
                                            <span>Sair</span>
                                        </button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                    @switch(Auth::user()->tipo)
                        @case("PROFESSOR")
                            @include('menu.professor')
                        @break
                        @case("ALUNO")
                            @include('menu.aluno')
                        @break
                        @default
                            @include('menu.admin')
                    @endswitch
                </ul>
            </div>
        </div>
    </nav>
    <section class="m-4 border rounded" id="wrapper">
        @include('components.message')
        @include('components.errors')
        @yield('painel')
    </section>
@endsection
@section('script')
    @parent
@endsection
