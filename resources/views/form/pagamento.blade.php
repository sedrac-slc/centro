@extends('layouts.dashboard')
@php
    $is_edit = !isset($aluno) ? isset($pagamento) : false;
    $data = ['rounded' => true];
    $method = $is_edit ? 'PUT' : 'POST';
    $aluno_disabled = false;
    $aluno_id = null;
    $aluno_nome = "";
    if (isset($pagamento->id)) {
        $aluno_nome = $pagamento->aluno->user->name;
        $aluno_disabled = true;
        $aluno_id = $pagamento->aluno_id;
    }
    if (isset($aluno->id)) {
        $aluno_nome = $aluno->user->name;
        $aluno_disabled = true;
        $aluno_id = $aluno->id;
    }
@endphp
@section('painel')
    <form id="form-nota" class="modal-content bg-white rounded" action="{{ $action }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method($method)
        <div class="modal-header">
            <h5 class="modal-title" id="modalUserTitle">{{ !isset($pagamento) ? 'Adicionar pagamento' : 'Editar pagamento' }}
            </h5>
        </div>
        <div class="modal-body">
            <section id="form-component">
                <div class="mb-2">
                    <label for="comprovativo"> @if($aluno_disabled) Comprovativo pagamento @else Faça o upload comprovativo do pagamento (.pdf) @endif</label>
                    <input type="file" value="{{ $pagamento->comprovativo ?? 0 }}" id="comprovativo" name="comprovativo" class="form-control" required>
                    @isset ($pagamento->comprovativo)
                        <a href="{{url("storage/{$pagamento->comprovativo}") }}" alt="Comprovativo">
                            <i class="fa-fas-eye"></i>
                            <span>Ver comprovativo de pagamento</span>
                        </a>
                    @endisset
                </div>
                <div class="mb-2">
                    <label for="preco">Digita o valor</label>
                    <input type="number" name="preco" value="{{ $pagamento->preco ?? 0 }}" id="preco"
                        class="form-control" min="0">
                </div>
                <div class="mb-2">
                    <label for="search-aluno"> @if($aluno_disabled) Nome aluno @else Digita o nome do aluno @endif</label>
                    <input type="search" value="{{ $aluno_nome }}" id="search-aluno" class="form-control"
                        @if ($aluno_disabled) disabled @endif>
                </div>
                @isset($pagamento->id)
                    <div class="mb-2">
                        <label for="">Curso</label>
                        <input type="search" value="{{ $pagamento->aluno->curso->nome }}" id="" class="form-control" disabled>
                    </div>
                    <div class="mb-2">
                        <label for="">Preço</label>
                        <input type="search" value="{{ $pagamento->aluno->curso->preco }}" id="" class="form-control" disabled>
                    </div>
                @endisset
                @isset($aluno->id)
                    <div class="mb-2">
                        <label for="">Curso</label>
                        <input type="search" value="{{ $aluno->curso->nome }}" id="" class="form-control" disabled>
                    </div>
                    <div class="mb-2">
                        <label for="">Preço</label>
                        <input type="search" value="{{ $aluno->curso->preco }}" id="" class="form-control" disabled>
                    </div>
                    <input type="hidden" name="back" id="back" value="alunos.index">
                @endisset
                <div id="table-aluno-result"></div>
                @if ($aluno_id != null)
                    <input type="hidden" name="aluno_id" value="{{ $aluno_id }}">
                @endif
                <div hidden>
                    <input type="hidden" name="" value="{{ route('alunos.ajax') }}" id="url-alunos">
                </div>
            </section>
        </div>
        <div class="modal-footer">
            <a class="btn btn-outline-info rounded" href="{{ $back ?? route('pagamentos.index') }}">
                <i class="fas fa-arrow-left"></i>
                <span>voltar</span>
            </a>
            <button type="submit" class="btn btn-outline-primary rounded">
                <i class="fas fa-save"></i>
                <span id="span-operaction">Cadastra</span>
            </button>
        </div>
    </form>
@endsection
@section('script')
    @parent
    @if (!$is_edit)
        <script src="{{ asset('js/alert.js') }}"></script>
        <script src="{{ asset('js/ajax/alunos_pagamento.js') }}"></script>
        <script src="{{ asset('js/search/alunos.js') }}"></script>
    @endif
@endsection
