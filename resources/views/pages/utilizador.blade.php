@extends('layouts.page', ['list' => $utilizadores])
@php
    use App\Utils\UserUtil;
@endphp
@section('buttons')
    <a class="btn btn-outline-primary rounded" href="{{ route($panel . '.create') }}">
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
        <div><i class="fas text-yellow fa-user-secret"></i><span>Tipo</span></div>
    </th>
    <th colspan="2">
        <div><i class="fas text-yellow fa-tools"></i><span>Acções</span></div>
    </th>
@endsection
@section('tbody')
    @foreach ($utilizadores as $user)
        <tr style="align-items: center;">
            <td class="text-center">
                @if ($user->image)
                    <a href="{{ url("storage/{$user->image}") }}">
                        <img src="{{ url("storage/{$user->image}") }}" alt="foto perfil" class="rounded-circle"
                            style="width: 40px; height: 40px;">
                    </a>
                @else
                    <a href="{{ asset('img/avatar.jpg') }}" class="m-2">
                        <img src="{{ asset('img/avatar.jpg') }}" alt="foto perfil" class="rounded-circle"
                            style="width: 35px; height: 35px;">
                    </a>
                    <br />
                    <button class="text-primary bg-none btn-file d-flex gap-1 align-items-center" data-bs-toggle="modal"
                        data-bs-target="#modalFile" url="{{ route('account.photo', $user->id) }}" method="PUT">
                        <i class="fas fa-plus"></i>
                        <span>adicionar</span>
                    </button>
                @endif
            </td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td data-vd="{{ $user->gender }}">
                {{ UserUtil::genders()[$user->gender] }}
            </td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->birthday }}</td>
            <td data-vd={{ $user->tipo }}>
                {{ UserUtil::tipos()[$user->tipo] }}
            </td>
            <td>
                <a href="{{ route($panel . '.edit', $user->id) }}"
                    class="text-info rounded btn-sm btn-user-tr d-flex gap-1 align-items-center">
                    <i class="fas fa-user-edit"></i>
                    <span>editar</span>
                </a>
            </td>
            <td>
                <a href="#" class="text-danger rounded btn-sm btn-del d-flex gap-1 align-items-center"
                    data-bs-toggle="modal" data-bs-target="#modalDelete" url="{{ route($panel . '.destroy', $user->id) }}"
                    method="DELETE">
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
        'title' => "Eliminar Utilizador",
        'message' => "Tens certeza que desejas eliminar este utilizador?"
    ])
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/fileupload.js') }}"></script>
    <script src="{{ asset('js/help/delete.js') }}"></script>
@endsection
