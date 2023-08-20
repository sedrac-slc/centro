@extends('layouts.page', ['list' => $disciplinas])
@section('buttons')
    <a class="btn btn-outline-primary rounded" href="{{ route($panel . '.create') }}">
        <i class="fas fa-plus"></i>
        <span>adicionar</span>
    </a>
@endsection
@section('thead')
    <th>
        <div><i class="fas fa-signature"></i><span>Nome</span></div>
    </th>
    <th>
        <div><i class="fa fa-comment"></i><span>Descrição</span></div>
    </th>
    <th colspan="2">
        <div><i class="fas fa-chalkboard"></i><span>Curso</span></div>
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
                <a href="{{ route('disciplinas.curso.add', $disciplina->id) }}"
                    class="text-warning rounded btn-sm btn-user-tr d-flex gap-1 align-items-center">
                    <i class="fas fa-plus"></i>
                    <span>adicionar</span>
                </a>
            </td>
            <td>
                <a href="{{ route('disciplinas.curso.list', $disciplina->id) }}"
                    class="text-success rounded btn-sm btn-user-tr d-flex gap-1 align-items-center">
                    <i class="fas fa-bars"></i>
                    <span>listar</span>
                    <sup>{{ sizeof($disciplina->cursos) }}</sup>
                </a>
            </td>
            <td>
                <a href="{{ route($panel . '.edit', $disciplina->id) }}"
                    class="text-info rounded btn-sm btn-user-tr d-flex gap-1 align-items-center">
                    <i class="fas fa-edit"></i>
                    <span>editar</span>
                </a>
            </td>
            <td>
                <a href="#" class="text-danger rounded btn-sm btn-del d-flex gap-1 align-items-center"
                    data-bs-toggle="modal" data-bs-target="#modalDelete"
                    url="{{ route($panel . '.destroy', $disciplina->id) }}" method="DELETE">
                    <i class="fas fa-times"></i>
                    <span>eliminar</span>
                </a>
            </td>
        </tr>
    @endforeach
@endsection
@section('modal')
    @include('components.modal.delete', [
        'title' => 'Eliminar disciplina',
        'message' => 'Tens certeza que desejas eliminar este disciplina?',
    ])
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/help/clearForm.help.js') }}"></script>
    <script src="{{ asset('js/help/delete.js') }}"></script>
    <script src="{{ asset('js/page/disciplina.js') }}"></script>
@endsection
