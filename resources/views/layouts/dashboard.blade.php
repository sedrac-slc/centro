@extends('layouts.template')
@php
    $isFarmaceutico = Auth::user()->tipo == 'FARMACEUTICO';
@endphp
@section('body', 'bg-light')
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}" />
@endsection
@section('content')
    <div class="d-flex" id="wrapper">
        <div class="border-end bg-primary text-white position-relative" id="sidebar-wrapper">
            <div class="sidebar-heading">
                <div class="text-center">
                    <div><span>Farmacia</span></div>
                </div>
            </div>
            <div class="list-group list-group-flush">
                <a href="/" class="list-group-item p-3 bg-primary text-white">
                    <i class="fas fa-home"></i>
                    <span>Página incial</span>
                </a>
                <a href="{{ route('home') }}"
                    class="@if (isset($panel) && $panel == 'account') list-group-item-action @else list-group-item @endif p-3 bg-primary text-white">
                    <i class="fas fa-user-circle"></i>
                    <span>Conta</span>
                </a>
                @if ($isFarmaceutico)
                    <a href="{{ route('utilizadores.index') }}"
                        class="@if (isset($panel) && $panel == 'utilizadores') list-group-item-action @else list-group-item @endif p-3 bg-primary text-white">
                        <i class="fas fa-users"></i>
                        <span>Utilizadores</span>
                    </a>
                    <a href="{{ route('medicamentos.index') }}"
                        class="@if (isset($panel) && $panel == 'medicamentos') list-group-item-action @else list-group-item @endif p-3 bg-primary text-white">
                        <i class="fa fa-user-md" aria-hidden="true"></i>
                        <span>Medicamentos</span>
                    </a>
                    <a href="{{ route('retiradas.index') }}"
                        class="@if (isset($panel) && $panel == 'retiradas') list-group-item-action @else list-group-item @endif p-3 bg-primary text-white">
                        <i class="fa fa-money-bill" aria-hidden="true"></i>
                        <span>Retiradas</span>
                    </a>
                @endif
                <a href="#"
                    class="@if (isset($panel) && $panel == 'relatorios') list-group-item-action @else list-group-item @endif p-3 bg-primary text-white">
                    <i class="fa fa-book" aria-hidden="true"></i>
                    <span>Relatórios</span>
                </a>
            </div>
            <div class="div-logout">

            </div>
        </div>

        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
                <div class="container-fluid">
                    <form class="d-flex gap-1" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-warning rounded" id="sidebarToggle">
                            <i class="fas fa-bars"></i>
                            <span>Menu</span>
                        </button>
                        <button type="submit" class="btn btn-danger rounded">
                            <i class="fas fa-power-off"></i>
                            <span>logaut</span>
                        </button>
                    </form>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation"><span
                            class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">

                        </ul>
                    </div>

                </div>
            </nav>
            <div class="container-fluid">
                @yield('painel')
            </div>
        </div>
    </div>
@endsection
@section('script')
    @parent

@endsection
