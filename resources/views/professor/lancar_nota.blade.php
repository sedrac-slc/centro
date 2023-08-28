@extends('layouts.page', ['list' => $alunos])
@section('form-open')
<form action="{{ route('lancar.store', $cursoDisciplina->id) }}" method="POST">
    @csrf
    <button class="btn btn-outline-primary rounded" type="submit">
        <i class="fas fa-plus"></i>
        <span>lançar</span>
    </button>
@endsection
    @section('thead')
        <th>
            <div><i class="fas fa-signature"></i><span>Nome</span></div>
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
        @foreach ($alunos as $aluno)
            @php $nota = nota($cursoDisciplina->id,$aluno->id) @endphp
            <tr style="text-align: center;">
                <td>
                    <input name="alunos[]" type="hidden" value="{{ $aluno->id }}">
                    <span>{{ $aluno->user->name }}</span>
                </td>
                <td>
                    <input class="notas form-control text-center" name="nota_primeiro[]" type="number" value="{{ $nota->nota_primeira ?? 0 }}" min="0"
                        max="20">
                </td>
                <td>
                    <input class="notas form-control text-center" name="nota_segunda[]" type="number" value="{{ $nota->nota_segunda ?? 0 }}" min="0"
                        max="20">
                </td>
                <td>
                    <input class="notas form-control text-center" name="nota_terceiro[]" type="number" value="{{ $nota->nota_terceira ?? 0 }}" min="0"
                        max="20">
                </td>
                <td>
                    <input class="form-control text-center" type="number" name="nota_final[]" value="{{ $nota->nota_final ?? 0 }}" min="0"
                        max="20" disabled>
                </td>
            </tr>
        @endforeach
    @endsection
@section('form-end')
</form>
@endsection
@section('script')
    @parent
    <script>
        ((doc)=>{
            const notasInput = doc.querySelectorAll(".notas");
            notasInput.forEach((item)=>{
                item.addEventListener('change',(e) => {
                    const row = item.parentElement.parentElement;
                    const notaFinal = row.querySelector("[name='nota_final[]']");
                    const notas = row.querySelectorAll(".notas");
                    let nota = 0;
                    notas.forEach(i => nota += parseInt(i.value))
                    notaFinal.value = Math.round(nota / notas.length);
                })
            })
        })(document)
    </script>
@endsection
