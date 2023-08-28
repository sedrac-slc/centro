@extends('layouts.dashboard')
@section('painel')
    <h3 class="m-2 p-2">
        <i class="fas text-yellow  fa-info-circle"></i>
        <span>Informações da conta</span>
    </h3>
    <div class="accordion m-auto bg-white p-3" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas text-yellow fa-user"></i>
                    <span>Dados pessoas</span>
                </button>
            </h2>
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

                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <i class="fas text-yellow fa-user-edit"></i>
                    <span>Actualização</span>
                </button>
            </h2>
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
                        <button class="btn btn-outline-warning  btn-file m-2 rounded" data-bs-toggle="modal"
                            data-bs-target="#modalFile" url="{{ route('account.photo', Auth::user()->id) }}" method="PUT">
                            <i class="fas text-yellow fa-plus"></i>
                            <span>Foto de perfil</span>
                        </button>
                        <button class="btn btn-outline-warning rounded m-2" type="submit">
                            <i class="fas text-yellow fa-save"></i>
                            <span>Guardar</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <i class="fas text-yellow fa-user-lock"></i>
                    <span>Segurança</span>
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action="{{ route('account.pass') }}" method="POST">
                        @csrf
                        @include('components.import.password', ['inline' => true])
                        <button class="btn btn-outline-warning rounded m-2" type="submit">
                            <i class="fas text-yellow fa-save"></i>
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
