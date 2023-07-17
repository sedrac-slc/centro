@extends('layouts.page', ['list' => $items])
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/page/home.css') }}" />
    <style>
        tbody td:not(:first-child) {
            padding-top: 1rem;
        }
    </style>
@endsection
@section('buttons')
    @isset($medicamento)
        <a class="btn btn-outline-info rounded" href="{{ url()->previous() }}">
            <i class="fas fa-arrow-left"></i>
            <span>voltar</span>
        </a>
    @endisset
    <button class="btn btn-outline-primary rounded" id="btn-add-item" data-bs-toggle="modal" data-bs-target="#modalItem"
        url="{{ route($panel . '.store') }}" method="POST">
        <i class="fas fa-plus"></i>
        <span>adicionar</span>
    </button>
    <button class="btn btn-outline-primary rounded" data-bs-toggle="modal" data-bs-target="#modalItemFiltro">
        <i class="fas fa-filter"></i>
        <span>filtros</span>
    </button>
    @if (isset($search) && $search)
        <a class="btn btn-outline-primary rounded" href="{{ route('items.index') }}">
            <i class="fas fa-circle-notch"></i>
            <span>recarregar</span>
        </a>
    @endif
@endsection
@section('thead')
    <th>
        <div><i class="fas fa-signature"></i><span>Medicamento</span></div>
    </th>
    <th>
        <div><i class="fas fa-envelope"></i><span>Código</span></div>
    </th>
    <th>
        <div><i class="fas fa-calendar"></i><span>Data validade</span></div>
    </th>
    <th colspan="2">
        <div><i class="fas fa-tools"></i><span>Acções</span></div>
    </th>
@endsection
@section('tbody')
    @foreach ($items as $item)
        <tr style="align-items: center;">
            <td data-value={{ $item->medicamento->id }}>{{ $item->medicamento->nome }}</td>
            <td>{{ $item->codigo }}</td>
            <td>{{ $item->data_validade }}</td>
            <td>
                <a href="#" class="text-info rounded btn-sm btn-item-tr d-flex gap-1 align-items-center"
                    data-bs-toggle="modal" data-bs-target="#modalItem" url="{{ route($panel . '.update', $item->id) }}"
                    method="PUT">
                    <i class="fas fa-edit"></i>
                    <span>editar</span>
                </a>
            </td>
            <td>
                <a href="#" class="text-danger rounded btn-sm btn-item-del d-flex gap-1 align-items-center"
                    data-bs-toggle="modal" data-bs-target="#modalItem" url="{{ route($panel . '.destroy', $item->id) }}"
                    method="DELETE">
                    <i class="fas fa-times"></i>
                    <span>eliminar</span>
                </a>
            </td>
        </tr>
    @endforeach
@endsection
<input type="hidden" id="url-json" value="{{ route('medicamentos.json') }}">
@section('modal')
    @include('components.modal.item', ['medicamento' => $medicamento ?? null])
    @include('components.modal.filtro.item')
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/help/clearForm.help.js') }}"></script>
    <script src="{{ asset('js/help/medicamento.js') }}"></script>
    <script src="{{ asset('js/page/item.js') }}"></script>
@endsection
