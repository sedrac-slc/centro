@extends('layouts.page', ['list' => $alunos])
@php
    use App\Utils\UserUtil;
@endphp
@section('css')
    @parent
    <style>
        .text-orange{color: orangered;}
    </style>
@endsection
@section('buttons')
    <a class="btn btn-outline-primary rounded" href="{{ route($panel . '.create') }}" >
        <i class="fas fa-user-plus"></i>
        <span>adicionar</span>
    </a>
@endsection
@section('thead')
    <th>
        <div><i class="fas text-yellow fa-image"></i><span>Foto</span></div>
    </th>
    <th>
        <div><i class="fas text-yellow fa-signature"></i><span>Nome</span></div>
    </th>
    <th>
        <div><i class="fas text-yellow fa-chalkboard"></i><span>Curso(Nome)</span></div>
    </th>
    <th>
        <div><i class="fas text-yellow fa-chalkboard"></i><span>Curso(Preço)</span></div>
    </th>
    <th>
        <div><i class="fas text-yellow fa-envelope"></i><span>Email</span></div>
    </th>
    <th>
        <div><i class="fas text-yellow fa-venus-mars"></i><span>Gênero</span></div>
    </th>
    <th>
        <div><i class="fas text-yellow fa-phone"></i><span>Telefone</span></div>
    </th>
    <th>
        <div><i class="fas text-yellow fa-calendar"></i><span>Data nascimento</span></div>
    </th>
    <th>
        <div><i class="fas text-yellow fa-clipboard"></i><span>Curso(Pago)</span></div>
    </th>
    <th colspan="2">
        <div><i class="fas text-yellow fa-money-bill"></i><span>Pagamento</span></div>
    </th>
    <th colspan="2">
        <div><i class="fas text-yellow fa-chalkboard"></i><span>Curso(Acções)</span></div>
    </th>
    <th colspan="2">
        <div><i class="fas text-yellow fa-tools"></i><span>Acções</span></div>
    </th>
@endsection
@section('tbody')
    @foreach ($alunos as $aluno)
        <tr style="align-items: center;" >
            <td class="text-center">
                @if ($aluno->user->image)
                    <a href="{{ url("storage/{$aluno->user->image}") }}">
                        <img src="{{ url("storage/{$aluno->user->image}") }}" alt="foto perfil" class="rounded-circle"
                            style="width: 40px; height: 40px;">
                    </a>
                @else
                    <a href="{{ asset('img/avatar.jpg') }}" class="m-2">
                        <img src="{{ asset('img/avatar.jpg') }}" alt="foto perfil" class="rounded-circle"
                            style="width: 35px; height: 35px;">
                    </a>
                    <br />
                    <button class="text-primary bg-none btn-file d-flex gap-1 align-items-center" data-bs-toggle="modal" data-bs-target="#modalFile"
                        url="{{ route('account.photo', $aluno->user->id) }}" method="PUT">
                        <i class="fas  fa-plus"></i>
                        <span>adicionar</span>
                    </button>
                @endif
            </td>
            <td>{{ $aluno->user->name }}</td>
            <td>{{ $aluno->curso->nome }}</td>
            <td>{{ $aluno->curso->preco }}</td>
            <td>{{ $aluno->user->email }}</td>
            <td data-vd="{{ $aluno->user->gender }}">
            {{ UserUtil::genders()[$aluno->user->gender] }}
            </td>
            <td>{{ $aluno->user->phone }}</td>
            <td>{{ $aluno->user->birthday }}</td>
            <td>{{ $aluno->is_pago ? "TERMINADO" : "NÃO TERMINADO" }}</td>
            <td>
                <a href="{{ route('alunos.pagamento.add',$aluno->id) }}" class="text-orange rounded btn-sm btn-user-tr d-flex gap-1 align-items-center">
                    <i class="fas fa-plus"></i>
                    <span>adicionar</span>
                </a>
            </td>
            <td>
                <a href="{{ route('alunos.pagamento.list',$aluno->id) }}" class="text-warning rounded btn-sm btn-user-del d-flex gap-1 align-items-center">
                    <i class="fas fa-list"></i>
                    <span>listar</span>
                    <sup>{{ sizeof($aluno->pagamentos) }}</sup>
                </a>
            </td>
            <td>
                <a href="{{ route('alunos.curso.add',$aluno->id) }}" class="text-primary rounded btn-sm btn-user-tr d-flex gap-1 align-items-center">
                    <i class="fas fa-plus"></i>
                    <span>adicionar</span>
                </a>
            </td>
            <td>
                <a href="{{ route('alunos.curso.list',$aluno->id) }}" class="text-success rounded btn-sm btn-user-del d-flex gap-1 align-items-center">
                    <i class="fas fa-list"></i>
                    <span>listar</span>
                    <sup>{{ count_aluno($aluno->user->id) }}</sup>
                </a>
            </td>
            <td>
                <a href="{{ route($panel . '.edit', $aluno->id) }}" class="text-info rounded btn-sm btn-user-tr d-flex gap-1 align-items-center">
                    <i class="fas fa-user-edit"></i>
                    <span>editar</span>
                </a>
            </td>
            <td>
                <a href="#" class="text-danger rounded btn-sm btn-del d-flex gap-1 align-items-center" data-bs-toggle="modal"
                    data-bs-target="#modalDelete" url="{{ route($panel . '.destroy', $aluno->id) }}" method="DELETE">
                    <i class="fas fa-user-times"></i>
                    <span>eliminar</span>
                </a>
            </td>
        </tr>
    @endforeach
@endsection
@section('modal')
    @include('components.modal.fileupload')
    @include('components.modal.delete',[
        'title' => "Eliminar Aluno",
        'message' => "Tens certeza que desejas eliminar este aluno?"
    ])
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/fileupload.js') }}"></script>
    <script src="{{ asset('js/help/delete.js') }}"></script>
@endsection
