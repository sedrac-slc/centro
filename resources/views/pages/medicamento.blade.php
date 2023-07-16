@extends('layouts.page', ['list' => $medicamentos])
@section('page-container')
@endsection
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/page/home.css') }}" />
@endsection
    @section('buttons')
        <button class="btn btn-outline-primary rounded" id="btn-add-user" data-bs-toggle="modal"
            data-bs-target="#modalMedicamento" url="{{ route($panel . '.store') }}" method="POST">
            <i class="fas fa-user-plus"></i>
            <span>adicionar</span>
        </button>
    @endsection
@section('thead')
    <th>
        <div><i class="fas fa-signature"></i><span>Nome</span></div>
    </th>
    <th>
        <div><i class="fa fa-list-ol" aria-hidden="true"></i><span>Quantidade(mínima)</span></div>
    </th>
    <th>
        <div><i class="fas fa-comment"></i><span>Descricao</span></div>
    </th>
    <th>
        <div><i class="fa fa-list-ol" aria-hidden="true"></i><span>Quantidade(Stock)</span></div>
    </th>
    <th colspan="2">
        <div><i class="fas fa-bars"></i><span>Items</span></div>
    </th>
    <th colspan="2">
        <div><i class="fas fa-tools"></i><span>Acções</span></div>
    </th>
@endsection
@section('tbody')
    @foreach ($medicamentos as $medicamento)
        <tr>
            <td>{{ $medicamento->nome }}</td>
            <td>{{ $medicamento->quantidade_minino_stock }}</td>
            <td>{{ $medicamento->descricao }}</td>
            <td>{{ sizeof($medicamento->items) }}</td>
            <td>
                <a href="#" class="text-primary rounded btn-sm btn-item-tr d-flex gap-1 align-items-center"
                    data-bs-toggle="modal" data-bs-target="#modalItem"
                    data-value="{{ $medicamento->nome }}" data-key="{{ $medicamento->id }}">
                    <i class="fas fa-plus"></i>
                    <span>adicionar</span>
                </a>
            </td>
            <td>
                <a href="{{ route('items.medicamento',$medicamento->id) }}" class="text-info rounded btn-sm btn-item-del d-flex gap-1 align-items-center">
                    <i class="fas fa-bars"></i>
                    <span>listar</span>
                </a>
            </td>
            <td>
                <a href="#" class="text-warning rounded btn-sm btn-user-tr d-flex gap-1 align-items-center"
                    data-bs-toggle="modal" data-bs-target="#modalMedicamento"
                    url="{{ route($panel . '.update', $medicamento->id) }}" method="PUT">
                    <i class="fas fa-user-edit"></i>
                    <span>editar</span>
                </a>
            </td>
            <td>
                <a href="#" class="text-danger rounded btn-sm btn-user-del d-flex gap-1 align-items-center"
                    data-bs-toggle="modal" data-bs-target="#modalMedicamento"
                    url="{{ route($panel . '.destroy', $medicamento->id) }}" method="DELETE">
                    <i class="fas fa-user-times"></i>
                    <span>eliminar</span>
                </a>
            </td>
        </tr>
    @endforeach
@endsection
@section('modal')
    @include('components.modal.medicamento')
    @include('components.modal.item',["route" => route('items.store')])
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/help/clearForm.help.js') }}"></script>
    <script src="{{ asset('js/help/textarea.help.js') }}"></script>
    <script src="{{ asset('js/page/medicamento.js') }}"></script>
@endsection
