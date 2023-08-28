@extends('layouts.page', ['list' => $cursos])
@section('buttons')
    <a class="btn btn-outline-primary rounded" href="{{ route('disciplinas.index') }}">
        <i class="fas fa-arrow-left"></i>
        <span>voltar</span>
    </a>
@endsection
@section('thead')
    <th>
        <div><i class="fas text-yellow fa-signature"></i><span>Nome</span></div>
    </th>
    <th>
        <div><i class="fa text-yellow fa-comment"></i><span>Descrição</span></div>
    </th>
    <th>
        <div><i class="fa text-yellow fa-calendar"></i><span>Data(Começo)</span></div>
    </th>
    <th>
        <div><i class="fa text-yellow fa-calendar-times"></i><span>Data(Termino)</span></div>
    </th>
    <th>
        <div><i class="fa text-yellow fa-clock"></i><span>Hora(Começo)</span></div>
    </th>
    <th>
        <div><i class="fas text-yellow fa-history"></i><span>Hora(Termino)</span></div>
    </th>
    <th>
        <div><i class="fab fa-buromobelexperte"></i><span>Sala</span></div>
    </th>
    <th colspan="1">
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
                <a href="#" class="text-danger rounded btn-sm btn-del d-flex gap-1 align-items-center"
                data-bs-toggle="modal" data-bs-target="#modalDelete"
                url="{{ route('curso-disciplina.destroy', $curso->curso_disciplina_id) }}" method="DELETE">
                    <i class="fas fa-times"></i>
                    <span>eliminar</span>
                </a>
            </td>
        </tr>
    @endforeach
@endsection
@section('modal')
    @include('components.modal.delete',[
        'title' => 'Remover curso da disciplina',
        'message' => "Tens certeza que desejas remove este curso na disciplina {$disciplina->nome}?",
    ])
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/help/clearForm.help.js') }}"></script>
    <script src="{{ asset('js/help/delete.js') }}"></script>
@endsection
