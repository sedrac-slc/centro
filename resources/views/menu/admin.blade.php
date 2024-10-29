<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <span>Utilizadores</span>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a class="dropdown-item" href="{{ route('utilizadores.index') }}">
                <span>Administradores</span>
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('alunos.index') }}">
                <span>Alunos</span>
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('professores.index') }}">
                <span>Professores</span>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <span>Gestão acadêmica</span>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a class="dropdown-item" href="{{ route('cursos.index') }}">
                <span>Curso</span>
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('disciplinas.index') }}">
                <span>Disciplina</span>
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('notas.index') }}">
                <span>Notas</span>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('pagamentos.index') }}">
        <span>Pagamentos</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('inscricoes.index') }}">
        <span>Inscrições</span>
    </a>
</li>
