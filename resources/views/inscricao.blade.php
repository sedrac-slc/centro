@extends('layouts.template')
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <style>
        .h-main {
            min-height: 60vh;
        }
    </style>
@endsection
@section('content')
    @include('menu.welcome', ['active' => 'inscricao'])
    <section class="container mb-4 h-main">
        @include('components.errors')
        <div class="mt-4 row">
            @foreach ($cursos as $curso)
                <div class="card col m-1" style="width: 10rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $curso->nome }}</h5>
                        <p class="card-text">{{ $curso->descricao }}</p>
                        <button type="button" class="btn btn-outline-warning btn-click-inscricao" data-bs-toggle="modal"
                            data-bs-target="#exampleModal" data-bs-whatever="@mdo" data-curso="{{ $curso->id }}">
                            Fazer inscrição
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form class="modal-content"action="{{ route('inscricao.store.public') }}" method="POST">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Informações para inscrição</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="curso" class="form-control" id="curso-selected">
                        <div class="row">
                            <div class="mb-2 col-md-6">
                                <label for="name" class="col-form-label">Nome:</label>
                                <input type="text" name="name" class="form-control" id="name">
                            </div>
                            <div class="mb-2 col-md-6">
                                <label for="email" class="col-form-label">Email:</label>
                                <input type="email" name="email" class="form-control" id="email">
                            </div>
                            <div class="mb-2 col-md-6">
                                <label for="phone" class="col-form-label">Contacto:</label>
                                <input type="number" name="phone" class="form-control" id="phone">
                            </div>
                            <div class="mb-2 col-md-6">
                                <label for="birthday" class="col-form-label">Data nascimento:</label>
                                <input type="date" name="birthday" class="form-control" id="birthday">
                            </div>
                            <div class="mb-2 col-md-6">
                                <label for="gender" class="col-form-label">Gênero:</label>
                                <select name="gender" class="form-control" id="gender">
                                    <option value="MALE">Masculino</option>
                                    <option value="FEMALE">Femenino</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Confirma</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    @include('components.footer')
@endsection
@section('script')
    <script>
        const curso = document.querySelector("#curso-selected");
        const btnItems = document.querySelectorAll('.btn-click-inscricao');

        btnItems.forEach((item) => {
            item.addEventListener('click', (e) => {
                curso.value = item.dataset.curso
            })
        })
    </script>
@endsection
