@extends('layouts.page', ['list' => $disciplinas])
@section('buttons')
    <a class="btn btn-outline-primary rounded" href="{{ route('cursos.index') }}">
        <i class="fas fa-arrow-left"></i>
        <span>voltar</span>
    </a>
@endsection
@section('thead')
    <th>
        <div><i class="fas fa-signature"></i><span>Nome</span></div>
    </th>
    <th>
        <div><i class="fa fa-comment"></i><span>Descrição</span></div>
    </th>
    <th>
        <div><i class="fas fa-tools"></i><span>Acções</span></div>
    </th>
@endsection
@section('tbody')
    @foreach ($disciplinas as $disciplina)
        <tr style="text-align: center;">
            <td>{{ $disciplina->nome }}</td>
            <td>{{ $disciplina->descricao }}</td>
            <td>
                <a href="#" class="text-danger rounded btn-sm btn-del d-flex gap-1 align-items-center"
                    data-bs-toggle="modal" data-bs-target="#modalDelete"
                    url="{{ route('curso-disciplina.destroy', $disciplina->curso_disciplina_id) }}" method="DELETE">
                    <i class="fas fa-times"></i>
                    <span>remove</span>
                </a>
            </td>
        </tr>
    @endforeach
@endsection
@section('modal')
    @include('components.modal.delete', [
        'title' => 'Remover disciplina no curso',
        'message' => "Tens certeza que desejas remove este disciplina no curso {$curso->nome}?",
    ])
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/help/clearForm.help.js') }}"></script>
    <script src="{{ asset('js/help/delete.js') }}"></script>
@endsection
