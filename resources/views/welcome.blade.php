@extends('layouts.template')
@section('css')
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        p {
            text-align: justify;
        }
    </style>
@endsection
@section('content')
    <div>
        <h2>Seja bem vindo a o SmartCentro</h2>
        <p>O nosso centro apresenta esta plataforma para todos os nossos funcionários e alunos tenham acesso a nosso serviço
        </p>
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
@endsection
