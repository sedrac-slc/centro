@extends('layouts.page', ['list' => $professores])
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
        <div><i class="fas fa-image"></i><span>Foto</span></div>
    </th>
    <th>
        <div><i class="fas fa-signature"></i><span>Nome</span></div>
    </th>
    <th>
        <div><i class="fas fa-chalkboard"></i><span>Curso(Nome)</span></div>
    </th>
    <th>
        <div><i class="fas fa-clipboard"></i><span>Disciplina</span></div>
    </th>
    <th>
        <div><i class="fas fa-envelope"></i><span>Email</span></div>
    </th>
    <th>
        <div><i class="fas fa-venus-mars"></i><span>Gênero</span></div>
    </th>
    <th>
        <div><i class="fas fa-phone"></i><span>Telefone</span></div>
    </th>
    <th>
        <div><i class="fas fa-calendar"></i><span>Data nascimento</span></div>
    </th>
    <th colspan="2">
        <div><i class="fas fa-chalkboard"></i><span>Curso-Disciplina(Acções)</span></div>
    </th>
    <th colspan="2">
        <div><i class="fas fa-tools"></i><span>Acções</span></div>
    </th>
@endsection
@section('tbody')
    @foreach ($professores as $professor)
        <tr style="align-items: center;">
            <td class="text-center">
                @if ($professor->user->image)
                    <a href="{{ url("storage/{$professor->user->image}") }}">
                        <img src="{{ url("storage/{$professor->user->image}") }}" alt="foto perfil" class="rounded-circle"
                            style="width: 40px; height: 40px;">
                    </a>
                @else
                    <a href="{{ asset('img/avatar.jpg') }}" class="m-2">
                        <img src="{{ asset('img/avatar.jpg') }}" alt="foto perfil" class="rounded-circle"
                            style="width: 35px; height: 35px;">
                    </a>
                    <br />
                    <button class="text-primary bg-none btn-file d-flex gap-1 align-items-center" data-bs-toggle="modal"
                        data-bs-target="#modalFile" url="{{ route('account.photo', $professor->user->id) }}" method="PUT">
                        <i class="fas fa-plus"></i>
                        <span>adicionar</span>
                    </button>
                @endif
            </td>
            <td>{{ $professor->user->name }}</td>
            <td>{{ $professor->curso }}</td>
            <td>{{ $professor->disciplina }}</td>
            <td>{{ $professor->user->email }}</td>
            <td data-vd="{{ $professor->user->gender }}">
                {{ UserUtil::genders()[$professor->user->gender] }}
            </td>
            <td>{{ $professor->user->phone }}</td>
            <td>{{ $professor->user->birthday }}</td>
            <td>
                <a href="{{ route('professores.curso_disciplina.add',$professor->id) }}" class="text-primary rounded btn-sm btn-user-tr d-flex gap-1 align-items-center">
                    <i class="fas fa-plus"></i>
                    <span>adicionar</span>
                </a>
            </td>
            <td>
                <a href="{{ route('professores.curso_disciplina.list',$professor->id) }}" class="text-success rounded btn-sm btn-user-del d-flex gap-1 align-items-center">
                    <i class="fas fa-list"></i>
                    <span>listar</span>
                    <sup>{{ count_professor($professor->user->id) }}</sup>
                </a>
            </td>
            <td>
                <a href="{{ route($panel . '.edit', $professor->id) }}" class="text-info rounded btn-sm btn-user-tr d-flex gap-1 align-items-center">
                    <i class="fas fa-user-edit"></i>
                    <span>editar</span>
                </a>
            </td>
            <td>
                <a href="#" class="text-danger rounded btn-sm btn-del d-flex gap-1 align-items-center"
                    data-bs-toggle="modal" data-bs-target="#modalDelete"
                    url="{{ route($panel . '.destroy', $professor->id) }}" method="DELETE">
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
        'title' => "Eliminar Professor",
        'message' => "Tens certeza que desejas eliminar este professor?"
    ])
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/fileupload.js') }}"></script>
    <script src="{{ asset('js/help/delete.js') }}"></script>
@endsection
