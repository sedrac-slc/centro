@extends('layouts.page', ['list' => $notas])
@section('buttons')
<a class="btn btn-outline-primary rounded" href="{{ $back }}">
    <i class="fas fa-arrow-left"></i>
    <span>voltar</span>
</a>
@endsection
@section('thead')
    <th>
        <div><i class="fas fa-clipboard"></i><span>Disciplina</span></div>
    </th>
    <th>
        <div><i class="fas fa-clipboard"></i><span>Nota(primeira)</span></div>
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
    @foreach ($notas as $aluno)
        <tr style="text-align: center;">
            <td>
                {{ $aluno->disciplina }}
            </td>
            <td>
                <input class="notas form-control text-center" name="nota_primeiro[]" type="number"
                    value="{{ $aluno->nota_primeira ?? 0 }}" min="0" max="20" disabled>
            </td>
            <td>
                <input class="notas form-control text-center" name="nota_segunda[]" type="number"
                    value="{{ $aluno->nota_segunda ?? 0 }}" min="0" max="20" disabled>
            </td>
            <td>
                <input class="notas form-control text-center" name="nota_terceiro[]" type="number"
                    value="{{ $aluno->nota_terceira ?? 0 }}" min="0" max="20" disabled>
            </td>
            <td>
                <input class="form-control text-center" type="number" name="nota_final[]"
                    value="{{ $aluno->nota_final ?? 0 }}" min="0" max="20" disabled>
            </td>
        </tr>
    @endforeach
@endsection
