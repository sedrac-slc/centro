@extends('layouts.template')
@php
    use App\Utils\UserUtil;
    $isAdministrador = UserUtil::isAdministrador(false);
@endphp
@section('body', 'bg-light')
@section('css')
    @parent
    <style>
        .btn-none,
        .bg-none {
            border: none;
            background: none;
        }
    </style>
@endsection
@section('content')
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Centro</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>Página incial</span>
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
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Procurar</button>
                </form>
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
