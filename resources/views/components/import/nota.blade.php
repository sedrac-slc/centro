<div class="row">
    <div class="col-md-12">
        @include('components.input', [
            'label' => 'Aluno:',
            'icon' => 'fas fa-signature',
            'type' => 'text',
            'name' => 'nome_aluno',
            'placeholder' => 'Digita o nome do medicamento',
            'require' => true,
            'value' => old('nome_aluno'),
        ])
    </div>
</div>
<div class="row mt-1 pb-3">
    <div class="col-md-4">
        @include('components.input', [
            'label' => 'Nota(primeira):',
            'icon' => 'fas fa-list',
            'type' => 'number',
            'name' => 'nota_primeira',
            'placeholder' => '',
            'require' => true,
            'value' => old('nota_primeira'),
        ])
    </div>
    <div class="col-md-4">
        @include('components.input', [
            'label' => 'Nota(segunda):',
            'icon' => 'fas fa-list',
            'type' => 'number',
            'name' => 'nota_segunda',
            'placeholder' => '',
            'require' => true,
            'value' => old('nota_segunda'),
        ])
    </div>
    <div class="col-md-4">
        @include('components.input', [
            'label' => 'Nota(Terceira):',
            'icon' => 'fas fa-list',
            'type' => 'number',
            'name' => 'nota_terceira',
            'placeholder' => '',
            'require' => true,
            'value' => old('nota_terceira'),
        ])
    </div>
</div>
