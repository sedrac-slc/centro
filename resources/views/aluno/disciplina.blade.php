@extends('layouts.page', ['list' => $disciplinas])
@section('thead')
    <th>
        <div><i class="fas fa-signature"></i><span>Nome</span></div>
    </th>
    <th>
        <div><i class="fa fa-comment"></i><span>Descrição</span></div>
    </th>
@endsection
@section('tbody')
    @foreach ($disciplinas as $disciplina)
        <tr style="text-align: center;">
            <td>{{ $disciplina->nome }}</td>
            <td>{{ $disciplina->descricao }}</td>
        </tr>
    @endforeach
@endsection