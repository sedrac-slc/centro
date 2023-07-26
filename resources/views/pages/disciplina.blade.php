@extends('layouts.page', ['list' => $disciplinas])
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/page/home.css') }}" />
    <style>
        tbody td:not(:first-child) {
            padding-top: 1rem;
        }
    </style>
@endsection
@section('buttons')
    @isset($back)
        <a class="btn btn-outline-primary rounded" href="{{ $back }}">
            <i class="fas fa-arrow-left"></i>
            <span>voltar</span>
        </a>
    @endisset
    <button class="btn btn-outline-primary rounded" id="btn-add-disciplina" data-bs-toggle="modal" data-bs-target="#modalDisciplina"
        url="{{ route($panel . '.store') }}" method="POST" data-nome="{{ Auth::user()->name }}">
        <i class="fas fa-plus"></i>
        <span>adicionar</span>
    </button>
@endsection
@section('thead')
    <th>
        <div><i class="fas fa-signature"></i><span>Nome</span></div>
    </th>
    <th>
        <div><i class="fa fa-commet"></i><span>Descrição</span></div>
    </th>
    <th colspan="2">
        <div><i class="fas fa-tools"></i><span>Acções</span></div>
    </th>
@endsection
@section('tbody')
    @foreach ($disciplinas as $disciplina)
        <tr style="text-align: center;">
            <td>{{ $disciplina->nome }}</td>
            <td>{{ $disciplina->descricao }}</td>
            <td>
                <a href="#" class="text-info rounded btn-sm btn-disciplina-tr d-flex gap-1"
                    data-bs-toggle="modal" data-bs-target="#modalDisciplina"
                    url="{{ route($panel . '.update', $disciplina->id) }}" method="PUT">
                    <i class="fas fa-edit"></i>
                    <span>editar</span>
                </a>
            </td>
            <td>
                <a href="#" class="text-danger rounded btn-sm btn-disciplina-del d-flex gap-1"
                    data-bs-toggle="modal" data-bs-target="#modalDisciplina"
                    url="{{ route($panel . '.destroy', $disciplina->id) }}" method="DELETE">
                    <i class="fas fa-times"></i>
                    <span>eliminar</span>
                </a>
            </td>
        </tr>
    @endforeach
@endsection
@section('modal')
    @include('components.modal.disciplina')
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/help/clearForm.help.js') }}"></script>
    <script src="{{ asset('js/page/disciplina.js') }}"></script>
@endsection
