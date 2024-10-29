@extends('layouts.page', ['list' => $inscricoes])
@section('thead')
    <th>
        <div><span>Curso</span></div>
    </th>
    <th>
        <div><span>Nome</span></div>
    </th>
    <th>
        <div><span>Contacto</span></div>
    </th>
    <th>
        <div><span>Email</span></div>
    </th>
    <th>
        <div><span>Data nascimento</span></div>
    </th>
    <th>
        <div><span>Gênero</span></div>
    </th>
    <th colspan="2">
        <div><span>Acções</span></div>
    </th>
@endsection
@section('tbody')
    @foreach ($inscricoes as $inscricao)
        <tr style="text-align: center;">
            <td>{{ $inscricao->curso->nome }}</td>
            <td>{{ $inscricao->nome }}</td>
            <td>{{ $inscricao->phone }}</td>
            <td>{{ $inscricao->email }}</td>
            <td>{{ $inscricao->birthday }}</td>
            <td>{{ $inscricao->gender }}</td>
            <td>
                <a href="#" class="text-info rounded btn-sm btn-user-tr d-flex gap-1 align-items-center btn-confirm-inscricao"
                    data-bs-toggle="modal" data-bs-target="#exampleModal" data-inscricao="{{ $inscricao->id }}">
                    <i class="fas fa-edit"></i>
                    <span>confirmar</span>
                </a>
            </td>
            <td>
                <a href="#" class="text-danger rounded btn-sm btn-del d-flex gap-1 align-items-center btn-delete-inscricao"
                    data-bs-toggle="modal" data-bs-target="#modalDelete" url="{{ route('inscricoes.delete', $inscricao->id) }}" method="DELETE">
                    <i class="fas fa-times"></i>
                    <span>eliminar</span>
                </a>
            </td>
        </tr>
    @endforeach
@endsection
@section('modal')
    @include('components.modal.delete', [
        'title' => 'Eliminar inscricao',
        'message' => 'Tens certeza que desejas eliminar este inscricao?',
    ])

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('inscricoes.confirm') }}" method="POST">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmação da inscrição</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div>
                        Ao realiazar esta operação, será criado um aluno com os dados do inscrito e a
                        sua inscrição será eliminida.
                    </div>
                    <hr />
                    <input type="hidden" name="inscricao" class="form-control" id="inscricao-form"/>
                    <div class="mb-2">
                        <label for="password" class="col-form-label">Senha:</label>
                        <input type="password" name="password" class="form-control" id="password"/>
                    </div>
                    <div class="mb-2">
                        <label for="confirm" class="col-form-label">Confirmação(senha):</label>
                        <input type="password" name="confirm" class="form-control" id="confirm"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Confirma</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/help/clearForm.help.js') }}"></script>
    <script src="{{ asset('js/help/delete.js') }}"></script>
    <script>

        const inscricao = document.querySelector('#inscricao-form');
        const btnItems = document.querySelectorAll('.btn-confirm-inscricao');

        btnItems.forEach((item) => {
            item.addEventListener('click', (e) => {
                inscricao.value = item.dataset.inscricao
            });
        });
    </script>
@endsection
