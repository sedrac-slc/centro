@extends('layouts.template')
@php
    use App\Utils\UserUtil;
    $isAdministrador = UserUtil::isAdministrador(false);
@endphp
@section('body', 'bg-light')
@section('content')

    <nav class="navbar navbar-expand-lg bg-yellow mb-4">
        <div class="container-fluid position-relative">
            <a class="navbar-brand" href="#">CentroSmart</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">
                            <i class="fa fa-home text-yellow" aria-hidden="true"></i>
                            <span>Perfil</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa fa-user-circle text-yellow" aria-hidden="true"></i>
                            <span>Conta</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="#">Nome: {{ short_name(auth()->user()->name) }}</a>
                            </li>
                        </ul>
                    </li>
                    @switch(Auth::user()->tipo)
                        @case('PROFESSOR')
                            @include('menu.professor')
                        @break

                        @case('ALUNO')
                            @include('menu.aluno')
                        @break

                        @default
                            @include('menu.admin')
                    @endswitch
                </ul>
            </div>
            <a href="#" class="text-white rounded btn-sm btn-del d-flex gap-1 align-items-center btn-logaut-my"
                data-bs-toggle="modal" data-bs-target="#modalLogaut">
                <i class="far fa-times-circle"></i>
                <span>Sair</span>
            </a>
        </div>
    </nav>

    <section class="m-4 border rounded" id="wrapper">
        @include('components.message')
        @include('components.errors')
        @yield('painel')
    </section>

    @include('components.modal.logout')
@endsection
@section('script')
    @parent
@endsection
