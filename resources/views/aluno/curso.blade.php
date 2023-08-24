@extends('layouts.page', ['list' => $cursos])
@section('thead')
    <th>
        <div><i class="fas fa-signature"></i><span>Nome</span></div>
    </th>
    <th>
        <div><i class="fas fa-money-bill"></i><span>Preço</span></div>
    </th>
    <th>
        <div><i class="fa fa-comment"></i><span>Descrição</span></div>
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
        <div><i class="fab fa-buromobelexperte"></i><span>Sala</span></div>
    </th>
    <th colspan="2">
        <div><i class="fas fa-tools"></i><span>Acção</span></div>
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
                <a href="{{ route('view.disciplinas',$curso->id) }}" class="text-info rounded btn-sm btn-user-tr d-flex gap-1 align-items-center">
                    <i class="fas fa-eyes"></i>
                    <span>disciplina</span>
                </a>
            </td>
            <td>
                <a href="{{ route('view.notas',$curso->id) }}" class="text-primary rounded btn-sm btn-user-tr d-flex gap-1 align-items-center">
                    <i class="fas fa-eyes"></i>
                    <span>notas</span>
                </a>
            </td>
        </tr>
    @endforeach
@endsection
