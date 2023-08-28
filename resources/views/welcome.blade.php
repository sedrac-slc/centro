@extends('layouts.template')
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
@endsection
@section('content')
    <header class="mb-3">
        <section class="container">
            <div class="row mt-2">
                <div class="col-md-6 conteudo-header">
                    <h2 class="">SmartCentro</h2>
                    <p>Seja bem vindo, a nosso centro apresenta esta plataforma do centro de formação smart, aqui poderás
                        fazer sobre os cursos que temos na nossa institução se informa sobre o preçário, caso desejas fazer
                        a inscrição aqui!</p>
                    @auth
                        <a class="btn btn-primary" href="{{ route('home') }}">
                            <span>Painel de controlo</span>
                        </a>
                    @else
                        <a class="btn btn-primary" href="{{ route('login') }}">
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
            <div class="col-md-7">
                <h3>
                    <i class="fas fa-tools text-yellow"></i>
                    <span>Serviço</span>
                </h3>
                <p class="text-justify">
                    Somos um centro de formação profissional para cursos técnicos, gestão e
                    administração, além deste serviço não forneçemos nenhum outros serviço,
                    poderás visualizar os nossos cursos e preçarios clicando no botão do card
                    a direita.
                </p>
            </div>
            <div class="col-md-5">
                <div class="card bg-yellow rounded">
                    <div class="card-body">
                        <h5 class="card-title text-white">Candidatura</h5>
                        <p class="card-text text-white">Desejas fazer a candidatura pelo nosso website?</p>
                        <a href="#" class="btn btn-primary">Clica aqui!</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container mb-4">
        <div class="row">
            <div class="col-md-6">
                <h3>
                    <i class="fas fa-map text-yellow"></i>
                    <span>Localização</span>
                </h3>
                <ul>
                    <li>
                        <strong class="text-yellow">País: </strong>
                        <span>Angola</span>
                    </li>
                    <li>
                        <strong class="text-yellow">Província: </strong>
                        <span>Benguela</span>
                    </li>
                    <li>
                        <strong class="text-yellow">Cidade: </strong>
                        <span>Benguela</span>
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <h3>
                    <i class="fas fa-phone text-yellow"></i>
                    <span>Contacto</span>
                </h3>
                <ul>
                    <li>
                        <strong class="text-yellow">Email: </strong>
                        <span>centrosmart@hotmail.com</span>
                    </li>
                    <li>
                        <strong class="text-yellow">Contacto: </strong>
                        <span>900-000-000</span>
                    </li>
                    <li>
                        <strong class="text-yellow">Código postal: </strong>
                        <span>00000</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <footer class="text-center text-lg-start bg-yellow">
        <div class="container d-flex justify-content-center py-5">
          <button type="button" class="btn btn-primary btn-lg btn-floating mx-2" style="background-color: #54456b;">
            <i class="fab fa-facebook-f"></i>
          </button>
          <button type="button" class="btn btn-primary btn-lg btn-floating mx-2" style="background-color: #54456b;">
            <i class="fab fa-youtube"></i>
          </button>
          <button type="button" class="btn btn-primary btn-lg btn-floating mx-2" style="background-color: #54456b;">
            <i class="fab fa-instagram"></i>
          </button>
          <button type="button" class="btn btn-primary btn-lg btn-floating mx-2" style="background-color: #54456b;">
            <i class="fab fa-twitter"></i>
          </button>
        </div>
        <div class="text-center text-white p-3" style="background-color: rgba(0, 0, 0, 0.2);">
          &copy; {{date('Y')}} Copyright:
          <a class="text-white" href="#">CentroSmarth</a>
        </div>
      </footer>
@endsection
