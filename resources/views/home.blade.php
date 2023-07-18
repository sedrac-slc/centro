@extends('layouts.dashboard')
@section('painel')
    <hr/>
    <section class="m-auto bg-white p-3">
        <ul class="nav nav-tabs p-2" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home"
                    aria-selected="true">Dados Pessoas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab"
                    aria-controls="profile" aria-selected="false">Actualização dados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab"
                    aria-controls="contact" aria-selected="false">Segurança</a>
            </li>
        </ul>
        <div class="tab-content p-2" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div>
                    @if (Auth::user()->image)
                        <a href="{{ url('storage/' . Auth::user()->image) }}" class="m-2">
                            <img src="{{ url('storage/' . Auth::user()->image) }}" alt="foto perfil" class="rounded-circle"
                                style="width: 100px; height: 100px;">
                        </a>
                    @else
                        <a href="{{ asset('img/avatar.jpg') }}" class="m-2">
                            <img src="{{ asset('img/avatar.jpg') }}" alt="foto perfil" class="rounded-circle"
                                style="width: 100px; height: 100px;">
                        </a>
                    @endif
                </div>
                @include('components.import.utilizador', [
                    'user' => Auth::user(),
                    'inline' => false,
                    'disabled' => true,
                    'password_hidden' => true,
                ])

                <button class="btn btn-warning  btn-file m-2 rounded" data-bs-toggle="modal" data-bs-target="#modalFile"
                    url="{{ route('account.photo', Auth::user()->id) }}" method="PUT">
                    <i class="fas fa-plus"></i>
                    <span>Foto de perfil</span>
                </button>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <form action="{{ route('account.update') }}" method="POST">
                    @csrf
                    @include('components.import.utilizador', [
                        'user' => Auth::user(),
                        'inline' => true,
                        'funcionario_readonly' => true,
                    ])
                    <button class="btn btn-primary rounded m-2" type="submit">
                        <i class="fas fa-check-circle"></i>
                        <span>Salvar</span>
                    </button>
                </form>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <form action="{{ route('account.pass') }}" method="POST">
                    @csrf
                    @include('components.import.password', ['inline' => true])
                    <button class="btn btn-warning rounded m-2" type="submit">
                        <i class="fas fa-check-circle"></i>
                        <span>Salvar</span>
                    </button>
                </form>
            </div>
        </div>
    </section>

    @include('components.modal.fileupload')
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/fileupload.js') }}"></script>
@endsection
