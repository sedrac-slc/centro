@extends('layouts.page', ['list' => $cursos])
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
    <button class="btn btn-outline-primary rounded" id="btn-add-curso" data-bs-toggle="modal" data-bs-target="#modalCurso"
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
    <th>
        <div><i class="fa fa-calendar"></i><span>Data(Começo)</span></div>
    </th>
    <th>
        <div><i class="fa fa-calendar-times"></i><span>Data(Termino)</span></div>
    </th>
    <th>
        <div><i class="fa fa-clock"></i><span>Hora(Começo)</span></div>
    </th>
    <th>
        <div><i class="fa fa-clock-times"></i><span>Hora(Termino)</span></div>
    </th>
    <th>
        <div><i class="fa fa-home"></i><span>Sala</span></div>
    </th>
    <th colspan="2">
        <div><i class="fas fa-tools"></i><span>Acções</span></div>
    </th>
@endsection
@section('tbody')
    @foreach ($cursos as $curso)
        <tr style="text-align: center;">
            <td>{{ $curso->nome }}</td>
            <td>{{ $curso->descricao }}</td>
            <td>{{ $curso->data_inicio }}</td>
            <td>{{ $curso->data_termino }}</td>
            <td>{{ $curso->hora_entrada }}</td>
            <td>{{ $curso->hora_termino }}</td>
            <td>{{ $curso->sala }}</td>
            <td>
                <a href="#" class="text-info rounded btn-sm btn-curso-tr d-flex gap-1"
                    data-bs-toggle="modal" data-bs-target="#modalcurso"
                    url="{{ route($panel . '.update', $curso->id) }}" method="PUT">
                    <i class="fas fa-edit"></i>
                    <span>editar</span>
                </a>
            </td>
            <td>
                <a href="#" class="text-danger rounded btn-sm btn-curso-del d-flex gap-1"
                    data-bs-toggle="modal" data-bs-target="#modalcurso"
                    url="{{ route($panel . '.destroy', $curso->id) }}" method="DELETE">
                    <i class="fas fa-times"></i>
                    <span>eliminar</span>
                </a>
            </td>
        </tr>
    @endforeach
@endsection
@section('modal')
    @include('components.modal.curso')
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/help/clearForm.help.js') }}"></script>
    <script src="{{ asset('js/page/curso.js') }}"></script>
@endsection
