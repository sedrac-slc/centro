@extends('layouts.page', ['list' => $alunos])
<form action="{{route('lancar.store', $cursoDisciplina->id)}}">
    @section('thead')
        <th>
            <div><i class="fas fa-signature"></i><span>Nome</span></div>
        </th>
        <th>
            <div><i class="fas fa-clipboard"><span>Nota(primeira)</span></div>
        </th>
        <th>
            <div><i class="fas fa-money-bill"></i><span>Nota(segunda)</span></div>
        </th>
        <th>
            <div><i class="fa fa-comment"></i><span>Nota(terceira)</span></div>
        </th>
        <th>
            <div><i class="fa fa-comment"></i><span>Nota(final)</span></div>
        </th>
    @endsection
    @section('tbody')
        @foreach ($alunos as $aluno)
            <tr style="text-align: center;">
                <td>
                    <input name="alunos[]" type="hidden" value="{{ $aluno->aluno_id }}">
                    <span>{{ $aluno->aluno }}</span>
                </td>
                <td>
                    <input name="nota_primeiro[]" type="number" value="{{ $aluno->nota_primeiro ?? 0 }}" min="0"
                        max="20">
                </td>
                <td>
                    <input name="nota_segunda[]" type="number" value="{{ $aluno->nota_segunda ?? 0 }}" min="0"
                        max="20">
                </td>
                <td>
                    <input name="nota_terceiro[]" type="number" value="{{ $aluno->nota_terceiro ?? 0 }}" min="0"
                        max="20">
                </td>
                <td>
                    <input type="number" name="nota_final[]" value="{{ $aluno->nota_final ?? 0 }}" min="0"
                        max="20" disabled>
                </td>
            </tr>
        @endforeach
    @endsection
</form>
