<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid text-dark">
        <a class="navbar-brand" href="#">
            <span class="bg-warning text-white p-2 rounded">Smart</span>
            <span class="text-dark">Centro</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active text-dark" aria-current="page" href="#">Página inicial</a>
                <a class="nav-link text-dark" href="{{ route('inscricao.public') }}">Inscrição</a>
            </div>
        </div>
    </div>
</nav>
