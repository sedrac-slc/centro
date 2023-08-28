@extends('layouts.page', ['list' => $pagamentos])
@section('buttons')
    @isset($back)
        <a class="btn btn-outline-info rounded" href="{{ $back }}">
            <i class="fas fa-arrow-left"></i>
            <span>voltar</span>
        </a>
    @endisset
    <a class="btn btn-outline-primary rounded" href="{{ route($panel . '.create') }}">
        <i class="fas fa-user-plus"></i>
        <span>adicionar</span>
    </a>
@endsection
@section('thead')
    <th>
        <div><i class="fas text-yellow fa-signature"></i><span>Aluno</span></div>
    </th>
    <th>
        <div><i class="fas text-yellow fa-chalkboard"></i><span>Curso(Nome)</span></div>
    </th>
    <th>
        <div><i class="fas text-yellow fa-chalkboard"></i><span>Curso(Preco)</span></div>
    </th>
    <th>
        <div><i class="fas text-yellow fa-clipboard"></i><span>Curso(Pago)</span></div>
    </th>
    <th>
        <div><i class="fas text-yellow fa-money-bill"></i><span>Total(Pago)</span></div>
    </th>
    <th>
        <div><i class="fas text-yellow fa-money-bill"></i><span>Valor(Entrego)</span></div>
    </th>
    <th>
        <div><i class="fas text-yellow fa-bars"></i><span>Prestação</span></div>
    </th>
    <th>
        <div><i class="fas text-yellow fa-list"></i><span>Troco</span></div>
    </th>
    <th colspan="2">
        <div><i class="fas text-yellow fa-tools"></i><span>Acções</span></div>
    </th>
@endsection
@section('tbody')
    @foreach ($pagamentos as $pagamento)
        <tr style="align-items: center;">
            <td>{{ $pagamento->aluno->user->name }}</td>
            <td>{{ $pagamento->aluno->curso->nome }}</td>
            <td>{{ $pagamento->aluno->curso->preco }}</td>
            <td>{{ $pagamento->aluno->is_pago ? "PAGO" : "NÃO PAGO" }}</td>
            <td>{{ $pagamento->is_pago_terminado ? "SIM" : "NÃO" }}</td>
            <td>{{ $pagamento->preco }}</td>
            <td>{{ $pagamento->prestacao }}</td>
            <td>{{ $pagamento->troco }}</td>
            <td>
                <a href="{{ route($panel . '.edit', $pagamento->id) }}"
                    class="text-info rounded btn-sm btn-user-tr d-flex gap-1 align-items-center">
                    <i class="fas fa-user-edit"></i>
                    <span>editar</span>
                </a>
            </td>
            <td>
                <a href="#" class="text-danger rounded btn-sm btn-del d-flex gap-1 align-items-center"
                    data-bs-toggle="modal" data-bs-target="#modalDelete"
                    url="{{ route($panel . '.destroy', $pagamento->id) }}" method="DELETE">
                    <i class="fas fa-user-times"></i>
                    <span>eliminar</span>
                </a>
            </td>
        </tr>
    @endforeach
@endsection
@section('modal')
    @include('components.modal.fileupload')
    @include('components.modal.delete', [
        'title' => 'Eliminar Pagamento',
        'message' => 'Tens certeza que desejas eliminar este pagamento?',
    ])
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/fileupload.js') }}"></script>
    <script src="{{ asset('js/help/delete.js') }}"></script>
@endsection
