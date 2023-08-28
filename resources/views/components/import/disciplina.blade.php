<div class="row">
    <div class="col-md-12">
        @include('components.input', [
            'label' => 'Nome:',
            'icon' => 'fas text-yellow fa-signature',
            'type' => 'text',
            'name' => 'nome',
            'placeholder' => 'Digita o nome do medicamento',
            'require' => true,
            'value' => $disciplina->nome ?? old('nome'),
        ])
    </div>
</div>
<div class="row mt-1 pb-3">
    <div class="col-md-12">
        @include('components.textaria', [
            'label' => 'Faça uma descrição:',
            'icon' => 'fas text-yellow fa-comment',
            'type' => 'text',
            'name' => 'descricao',
            'placeholder' => 'Escreva uma descrição curta',
            'require' => true,
            'value' => $disciplina->nome ?? old('descricao'),
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
            'disabled' => $disabled ?? false,
            'rows' => 3,
        ])
    </div>
</div>
