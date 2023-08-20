<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
        aria-expanded="false">
        <i class="fa fa-users" aria-hidden="true"></i>
        <span>Utilizadores</span>
    </a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('utilizadores.index') }}"><i
                    class="fas fa-user-tie"></i><span>Administradores</span></a></li>
        <li><a class="dropdown-item" href="{{ route('alunos.index') }}"><i
                    class="fas fa-user-graduate"></i><span>Alunos</span></a></li>
        <li><a class="dropdown-item" href="{{ route('professores.index') }}"><i
                    class="fas fa-chalkboard-teacher"></i><span>Professores</span></a></li>
    </ul>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
        aria-expanded="false">
        <i class="fa fa-cogs" aria-hidden="true"></i>
        <span>Gestão acadêmica</span>
    </a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('cursos.index') }}"><i
                    class="fas fa-chalkboard"></i><span>Curso</span></a></li>
        <li><a class="dropdown-item" href="{{ route('disciplinas.index') }}"><i
                    class="fas fa-clipboard"></i><span>Disciplina</span></a></li>
        <li><a class="dropdown-item" href="{{ route('notas.index') }}"><i
                    class="fas fa-clipboard-list"></i><span>Notas</span></a></li>
    </ul>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('pagamentos.index') }}">
        <i class="fa fa-money-bill" aria-hidden="true"></i>
        <span>Pagamentos</span>
    </a>
</li>
