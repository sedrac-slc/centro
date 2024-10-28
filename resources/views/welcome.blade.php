@extends('layouts.template')
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
@endsection
@section('content')
    @include('menu.welcome')
    <header class="mb-3">
        <section class="container">
            <div class="row mt-2">
                <div class="col-md-6 conteudo-header">
                    <h2 class="text-yellow">SmartCentro</h2>
                    <p>Seja bem vindo, a nosso centro apresenta esta plataforma do centro de formação smart, aqui poderás
                        fazer sobre os cursos que temos na nossa institução se informa sobre o preçário, caso desejas fazer
                        a inscrição aqui!</p>
                    @auth
                        <a class="btn btn-outline-warning btn-lg" href="{{ route('home') }}">
                            <span>Painel de controlo</span>
                        </a>
                    @else
                        <a class="btn btn-outline-warning btn-lg" href="{{ route('login') }}">
                            <span>Login</span>
                        </a>
                    @endauth
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('img/graduating.png') }}" alt="">
                </div>
            </div>
        </section>
    </header>
    <section class="container mb-4">
        <div class="row">
            <!-- Card de Usabilidade -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Usabilidade</h5>
                        <p class="card-text">Interface fácil e intuitiva, projetada para alunos e administradores.</p>
                    </div>
                </div>
            </div>

            <!-- Card de Segurança -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Segurança</h5>
                        <p class="card-text">Proteção avançada de dados e privacidade para uma experiência segura.</p>
                    </div>
                </div>
            </div>

            <!-- Card de Portabilidade -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Portabilidade</h5>
                        <p class="card-text">Acesse o centro de formação de qualquer dispositivo, a qualquer momento.</p>
                    </div>
                </div>
            </div>

            <!-- Card de Eficiência -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Eficiência</h5>
                        <p class="card-text">Automatize processos para uma gestão rápida e eficaz das operações diárias.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="text-center text-lg-start">
        <div class="container d-flex justify-content-center py-5">
            <button type="button" class="btn btn-warning btn-lg btn-floating mx-2">
                <i class="fab fa-facebook-f"></i>
            </button>
            <button type="button" class="btn btn-warning btn-lg btn-floating mx-2">
                <i class="fab fa-youtube"></i>
            </button>
            <button type="button" class="btn btn-warning btn-lg btn-floating mx-2">
                <i class="fab fa-instagram"></i>
            </button>
            <button type="button" class="btn btn-warning btn-lg btn-floating mx-2">
                <i class="fab fa-twitter"></i>
            </button>
        </div>
        <div class="text-center text-white p-2 bg-warning">
            &copy; {{ date('Y') }} Copyright:
            <a class="text-white" href="#">CentroSmarth</a>
        </div>
    </footer>
@endsection
