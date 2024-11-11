@extends('layouts.page', ['list' => $alunos])
@php
    $cumb =$cursoDisciplina->curso->nome .' - '. $cursoDisciplina->disciplina->nome;
@endphp
@section('form-open')
    <form action="{{ route('lancar.store', $cursoDisciplina->id) }}" method="POST">
        @csrf
        <a class="btn btn-outline-primary rounded" href="{{ $back }}">
            <i class="fas fa-arrow-left"></i>
            <span>voltar</span>
        </a>
        <button class="btn btn-outline-primary rounded" type="submit">
            <i class="fas fa-plus"></i>
            <span>lançar</span>
        </button>
    @endsection
    @section('thead')
        <th>
            <div><span>Nome</span></div>
        </th>
        <th>
            <div><span>Nota(primeira)</span></div>
        </th>
        <th>
            <div><span>Nota(segunda)</span></div>
        </th>
        <th>
            <div><span>Nota(terceira)</span></div>
        </th>
        <th>
            <div><span>Nota(final)</span></div>
        </th>
        <th>
            <div><span>Acção</span></div>
        </th>
    @endsection
    @section('tbody')
        @foreach ($alunos as $aluno)
            @php $nota = nota($cursoDisciplina->id, $aluno->id) @endphp
            <tr style="text-align: center;">
                <td>
                    <input name="alunos[]" type="hidden" value="{{ $aluno->id }}">
                    <span>{{ $aluno->user->name }}</span>
                </td>
                <td>
                    <input class="notas form-control text-center" name="nota_primeiro[]" type="number"
                        value="{{ $nota->nota_primeira ?? 0 }}" min="0" max="20" max>
                </td>
                <td>
                    <input class="notas form-control text-center" name="nota_segunda[]" type="number"
                        value="{{ $nota->nota_segunda ?? 0 }}" min="0" max="20">
                </td>
                <td>
                    <input class="notas form-control text-center" name="nota_terceiro[]" type="number"
                        value="{{ $nota->nota_terceira ?? 0 }}" min="0" max="20">
                </td>
                <td>
                    <input class="form-control text-center" type="number" name="nota_final[]"
                        value="{{ $nota->nota_final ?? 0 }}" min="0" max="20" disabled>
                </td>
                <td>
                    @isset($nota->id)
                        <a href="#" class="text-danger rounded btn-sm btn-del d-flex gap-1 mt-2 align-items-center"
                            data-bs-toggle="modal" data-bs-target="#modalDelete" url="{{ route('notas.destroy', $nota->id) }}"
                            method="DELETE">
                            <i class="fas fa-user-times"></i>
                            <span>eliminar</span>
                        </a>
                    @else
                        <span>-</span>
                    @endisset
                </td>
            </tr>
        @endforeach
    @endsection
    @section('form-end')
    </form>
@endsection
@section('modal')
    @include('components.modal.delete', [
        'title' => 'Eliminar Nota',
        'message' => 'Tens certeza que desejas eliminar este nota?',
    ])
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/help/delete.js') }}"></script>
    <script>
        ((doc) => {
            const notasInput = doc.querySelectorAll(".notas");
            notasInput.forEach((item) => {
                item.addEventListener('change', (e) => {
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
