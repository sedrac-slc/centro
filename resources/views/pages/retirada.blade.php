@extends('layouts.page', ['list' => $retiradas])
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
    <button class="btn btn-outline-primary rounded" id="btn-add-retirada" data-bs-toggle="modal" data-bs-target="#modalRetirada"
        url="{{ route($panel . '.store') }}" method="POST" data-nome="{{ Auth::user()->name }}">
        <i class="fas fa-plus"></i>
        <span>adicionar</span>
    </button>
@endsection
@section('thead')
    <th>
        <div><i class="fas fa-user-md"></i><span>Medicamento</span></div>
    </th>
    <th>
        <div><i class="fa fa-list-ol" aria-hidden="true"></i><span>Quantidade(inicial)</span></div>
    </th>
    <th>
        <div><i class="fa fa-list-ol" aria-hidden="true"></i><span>Quantidade(Retirada)</span></div>
    </th>
    <th>
        <div><i class="fa fa-list-ol" aria-hidden="true"></i><span>Quantidade(Stock)</span></div>
    </th>
    <th colspan="2">
        <div><i class="fas fa-tools"></i><span>Acções</span></div>
    </th>
@endsection
@section('tbody')
    @foreach ($retiradas as $retirada)
        <tr style="align-retiradas: center;">
            <td>{{ $retirada->medicamento->nome }}</td>
            <td>{{ $retirada->quantidade_inicial }}</td>
            <td>{{ $retirada->quantidade_retirada }}</td>
            <td>{{ $retirada->quantidade_stock }}</td>
            <td>
                <a href="#" class="text-info rounded btn-sm btn-retirada-tr d-flex gap-1 align-retiradas-center"
                    data-bs-toggle="modal" data-bs-target="#modalRetirada"
                    url="{{ route($panel . '.update', $retirada->id) }}" method="PUT">
                    <i class="fas fa-edit"></i>
                    <span>editar</span>
                </a>
            </td>
            <td>
                <a href="#" class="text-danger rounded btn-sm btn-retirada-del d-flex gap-1 align-retiradas-center"
                    data-bs-toggle="modal" data-bs-target="#modalRetirada"
                    url="{{ route($panel . '.destroy', $retirada->id) }}" method="DELETE">
                    <i class="fas fa-times"></i>
                    <span>eliminar</span>
                </a>
            </td>
        </tr>
    @endforeach
@endsection
<input type="hidden" id="url-json" value="{{ route('medicamentos.json') }}">
@section('modal')
    @include('components.modal.retirada')
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/help/clearForm.help.js') }}"></script>
    <script src="{{ asset('js/help/medicamento.js') }}"></script>
    <script src="{{ asset('js/page/retirada.js') }}"></script>
@endsection
