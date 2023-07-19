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
    <a class="btn btn-outline-primary rounded" href="{{ route('retiradas.index') }}">
        <i class="fas fa-arrow-left"></i>
        <span>voltar</span>
    </a>
    <button class="btn btn-outline-primary rounded" id="btn-add-item" data-bs-toggle="modal" data-bs-target="#modalItem"
        url="{{ route($panel . '.store') }}" method="POST">
        <i class="fas fa-plus"></i>
        <span>adicionar</span>
    </button>
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
@endsection
@section('tbody')
    @foreach ($items as $item)
        <tr style="align-items: center;">
            <td data-value={{ $item->medicamento->id }}>{{ $item->medicamento->nome }}</td>
            <td>{{ $item->codigo }}</td>
            <td>{{ $item->data_validade }}</td>
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
