@extends('layouts.page', ['list' => $notas])
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
        <div><i class="fas fa-signature"></i><span>Curso</span></div>
    </th>
    <th>
        <div><i class="fas fa-signature"></i><span>Disciplina</span></div>
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
            <td>{{ $nota->aluno->user->name }}</td>
            <td>{{ $nota->curso_disciplina->curso->nome }}</td>
            <td>{{ $nota->curso_disciplina->disciplina->nome }}</td>
            <td>{{ $nota->nota_primeira }}</td>
            <td>{{ $nota->nota_segunda }}</td>
            <td>{{ $nota->nota_terceira }}</td>
            <td>{{ $nota->nota_final }}</td>
            <td>
                <a href="{{ route('notas.edit', $nota->id) }}" class="text-info rounded btn-sm btn-nota-tr d-flex gap-1">
                    <i class="fas fa-edit"></i>
                    <span>editar</span>
                </a>
            </td>
            <td>
                <a href="#" class="text-danger rounded btn-sm btn-del d-flex gap-1" data-bs-toggle="modal"
                    data-bs-target="#modalNota" url="{{ route($panel . '.destroy', $nota->id) }}" method="DELETE">
                    <i class="fas fa-times"></i>
                    <span>eliminar</span>
                </a>
            </td>
        </tr>
    @endforeach
@endsection
@section('modal')
    @include('components.modal.delete', [
        'title' => 'Eliminar nota',
        'message' => 'Tens certeza que desejas eliminar esta nota?',
    ])
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/help/clearForm.help.js') }}"></script>
    <script src="{{ asset('js/help/delete.js') }}"></script>
@endsection
