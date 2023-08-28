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

        .section{
            margin-top: 5rem;
        }
    </style>
@endsection
@section('content')
    <div class="mt-4 section">
        <h2>Seja bem vindo a o SmartCentro</h2>
        <hr/>
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
