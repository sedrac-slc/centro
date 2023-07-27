@extends('layouts.page', ['list' => $notas])
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
    <button class="btn btn-outline-primary rounded" id="btn-add-nota" data-bs-toggle="modal" data-bs-target="#modalNota"
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
        <div><i class="fa fa-list"></i><span>Nota(primeira)</span></div>
    </th>
    <th>
        <div><i class="fa fa-list"></i><span>Nota(Segunda)</span></div>
    </th>
    <th>
        <div><i class="fa fa-list"></i><span>Nota(terceira)</span></div>
    </th>
    <th>
        <div><i class="fa fa-list"></i><span>Nota(final)</span></div>
    </th>
    <th colspan="2">
        <div><i class="fas fa-tools"></i><span>Acções</span></div>
    </th>
@endsection
@section('tbody')
    @foreach ($notas as $nota)
        <tr style="text-align: center;">
            <td>{{ $nota->aluno->user->nome }}</td>
            <td>{{ $nota->nota_primeira }}</td>
            <td>{{ $nota->nota_segunda }}</td>
            <td>{{ $nota->nota_terceira }}</td>
            <td>{{ $nota->nota_final }}</td>
            <td>
                <a href="#" class="text-info rounded btn-sm btn-nota-tr d-flex gap-1"
                    data-bs-toggle="modal" data-bs-target="#modalNota"
                    url="{{ route($panel . '.update', $nota->id) }}" method="PUT">
                    <i class="fas fa-edit"></i>
                    <span>editar</span>
                </a>
            </td>
            <td>
                <a href="#" class="text-danger rounded btn-sm btn-nota-del d-flex gap-1"
                    data-bs-toggle="modal" data-bs-target="#modalNota"
                    url="{{ route($panel . '.destroy', $nota->id) }}" method="DELETE">
                    <i class="fas fa-times"></i>
                    <span>eliminar</span>
                </a>
            </td>
        </tr>
    @endforeach
@endsection
@section('modal')
    @include('components.modal.nota')
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/help/clearForm.help.js') }}"></script>
    <script src="{{ asset('js/page/nota.js') }}"></script>
@endsection
