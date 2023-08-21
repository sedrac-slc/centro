@extends('layouts.page', ['list' => $cursoDisciplinas])
@section('buttons')
    <a class="btn btn-outline-primary rounded" href="{{ route('professores.index') }}">
        <i class="fas fa-arrow-left"></i>
        <span>voltar</span>
    </a>
@endsection
@section('thead')
    <th>
        <div><i class="fas fa-chalkboard"></i><span>Curso</span></div>
    </th>
    <th>
        <div><i class="fas fa-money-bill"></i><span>Preço</span></div>
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
        <div><i class="fas fa-history"></i><span>Hora(Termino)</span></div>
    </th>
    <th>
        <div><i class="fas fa-clipboard"></i><span>Disciplina</span></div>
    </th>
    <th colspan="1">
        <div><i class="fas fa-tools"></i><span>Acções</span></div>
    </th>
@endsection
@section('tbody')
    @foreach ($cursoDisciplinas as $cursoDisciplina)
        @php $curso = $cursoDisciplina->curso;  @endphp
        <tr style="text-align: center;">
            <td>{{ $curso->nome }}</td>
            <td>{{ $curso->preco }}</td>
            <td>{{ $curso->data_inicio }}</td>
            <td>{{ $curso->data_termino }}</td>
            <td>{{ $curso->hora_entrada }}</td>
            <td>{{ $curso->hora_termino }}</td>
            <td>{{ $cursoDisciplina->disciplina->nome }}</td>
            <td>
                <a href="#" class="text-danger rounded btn-sm btn-del"
                data-bs-toggle="modal" data-bs-target="#modalDelete"
                url="{{ route('professores.destroy', $cursoDisciplina->professor_id) }}" method="DELETE">
                    <i class="fas fa-times"></i>
                    <span>eliminar</span>
                </a>
            </td>
        </tr>
    @endforeach
@endsection
@section('modal')
    @include('components.modal.delete',[
        'title' => 'Remover professor do curso',
        'message' => "Tens certeza que desejas remove este professor no curso?",
    ])
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/help/clearForm.help.js') }}"></script>
    <script src="{{ asset('js/help/delete.js') }}"></script>
@endsection