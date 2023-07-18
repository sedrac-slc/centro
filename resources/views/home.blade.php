@extends('layouts.dashboard')
@section('painel')
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home"
                aria-selected="true">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                aria-selected="false">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                aria-selected="false">Contact</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
    </div>
    <div class="accordion mt-5" id="accordionExample">
        <div class="accordion-item">
            <h4 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    Dados Pessoas
                </button>
            </h4>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div>
                        @if (Auth::user()->image)
                            <a href="{{ url('storage/' . Auth::user()->image) }}" class="m-2">
                                <img src="{{ url('storage/' . Auth::user()->image) }}" alt="foto perfil"
                                    class="rounded-circle" style="width: 100px; height: 100px;">
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
            </div>
        </div>
        <div class="accordion-item">
            <h4 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Actualização dados
                </button>
            </h4>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
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
            </div>
        </div>
        <div class="accordion-item">
            <h4 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Segurança
                </button>
            </h4>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
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
        </div>
    </div>

    @include('components.modal.fileupload')
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/fileupload.js') }}"></script>
@endsection
