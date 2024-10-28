@extends('layouts.page', ['list' => $cursos])
@section('buttons')
    <a class="btn btn-outline-primary rounded" href="{{ route($panel . '.create') }}">
        <i class="fas fa-plus"></i>
        <span>adicionar</span>
    </a>
@endsection
@section('thead')
    <th>
        <div><span>Nome</span></div>
    </th>
    <th>
        <div><span>Preço</span></div>
    </th>
    <th>
        <div><span>Descrição</span></div>
    </th>
    <th>
        <div><span>Data(Começo)</span></div>
    </th>
    <th>
        <div><span>Data(Termino)</span></div>
    </th>
    <th>
        <div><span>Hora(Começo)</span></div>
    </th>
    <th>
        <div><span>Hora(Termino)</span></div>
    </th>
    <th>
        <div><span>Sala</span></div>
    </th>
    <th colspan="2">
        <div><span>Disciplina</span></div>
    </th>
    <th colspan="2">
        <div><span>Acções</span></div>
    </th>
@endsection
@section('tbody')
    @foreach ($cursos as $curso)
        <tr style="text-align: center;">
            <td>{{ $curso->nome }}</td>
            <td>{{ $curso->preco }}</td>
            <td>{{ $curso->descricao }}</td>
            <td>{{ $curso->data_inicio }}</td>
            <td>{{ $curso->data_termino }}</td>
            <td>{{ $curso->hora_entrada }}</td>
            <td>{{ $curso->hora_termino }}</td>
            <td>{{ $curso->sala }}</td>
            <td>
                <a href="{{ route('cursos.disciplina.add', $curso->id) }}"
                    class="text-warning rounded btn-sm btn-user-tr d-flex gap-1 align-items-center">
                    <i class="fas fa-plus"></i>
                    <span>adicionar</span>
                </a>
            </td>
            <td>
                <a href="{{ route('cursos.disciplina.list', $curso->id) }}"
                    class="text-success rounded btn-sm btn-user-tr d-flex gap-1 align-items-center">
                    <i class="fas fa-bars"></i>
                    <span>listar</span>
                    <sup>{{ sizeof($curso->disciplinas) }}</sup>
                </a>
            </td>
            <td>
                <a href="{{ route($panel . '.edit', $curso->id) }}"
                    class="text-info rounded btn-sm btn-user-tr d-flex gap-1 align-items-center">
                    <i class="fas fa-edit"></i>
                    <span>editar</span>
                </a>
            </td>
            <td>
                <a href="#" class="text-danger rounded btn-sm btn-del d-flex gap-1 align-items-center"
                    data-bs-toggle="modal" data-bs-target="#modalDelete" url="{{ route($panel . '.destroy', $curso->id) }}"
                    method="DELETE">
                    <i class="fas fa-times"></i>
                    <span>eliminar</span>
                </a>
            </td>
        </tr>
    @endforeach
@endsection
@section('modal')
    @include('components.modal.delete',[
        'title' => "Eliminar curso",
        'message' => "Tens certeza que desejas eliminar este curso?"
    ])
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/help/clearForm.help.js') }}"></script>
    <script src="{{ asset('js/help/delete.js') }}"></script>
@endsection
