@extends('layouts.page', ['list' => $curso_disciplinas])
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
    <button class="btn btn-outline-primary rounded" id="btn-add-curso-disciplina" data-bs-toggle="modal" data-bs-target="#modalCursoDisciplina"
        url="{{ route($panel . '.store') }}" method="POST" data-nome="{{ Auth::user()->name }}">
        <i class="fas fa-plus"></i>
        <span>adicionar</span>
    </button>
@endsection
@section('thead')
    <th>
        <div><i class="fas text-yellow fa-signature"></i><span>Curso</span></div>
    </th>
    <th>
        <div><i class="fa fa-commet"></i><span>Disciplina</span></div>
    </th>
    <th colspan="2">
        <div><i class="fas text-yellow fa-tools"></i><span>Acções</span></div>
    </th>
@endsection
@section('tbody')
    @foreach ($curso_disciplinas as $curso_disciplina)
        <tr style="text-align: center;">
            <td>{{ $curso_disciplina->curso->nome }}</td>
            <td>{{ $curso_disciplina->disciplina->nome }}</td>
            <td>
                <a href="#" class="text-info rounded btn-sm btn-curso-disciplina-tr d-flex gap-1"
                    data-bs-toggle="modal" data-bs-target="#modalCursoDisciplina"
                    url="{{ route($panel . '.update', $curso_disciplina->id) }}" method="PUT">
                    <i class="fas fa-edit"></i>
                    <span>editar</span>
                </a>
            </td>
            <td>
                <a href="#" class="text-danger rounded btn-sm btn-curso-disciplina-del d-flex gap-1"
                    data-bs-toggle="modal" data-bs-target="#modalCursoDisciplina"
                    url="{{ route($panel . '.destroy', $curso_disciplina->id) }}" method="DELETE">
                    <i class="fas fa-times"></i>
                    <span>eliminar</span>
                </a>
            </td>
        </tr>
    @endforeach
@endsection
@section('modal')
    @include('components.modal.curso_disciplina')
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/help/clearForm.help.js') }}"></script>
    <script src="{{ asset('js/page/curso_disciplina.js') }}"></script>
@endsection
