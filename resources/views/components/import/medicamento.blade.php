<div class="row mt-1">
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Nome:',
            'icon' => 'fas fa-signature',
            'type' => 'text',
            'name' => 'nome',
            'placeholder' => 'Digita o nome do medicamento',
            'require' => true,
            'value' => old('nome'),
        ])
    </div>
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Quantidade mínimo:',
            'icon' => 'fas fa-signature',
            'type' => 'number',
            'name' => 'quantidade_minino_stock',
            'placeholder' => 'Digita a quantidade mínima',
            'require' => true,
            'value' => old('quantidade_minino_stock'),
            'min' => 0,
        ])
    </div>
</div>
<div class="row mt-1 pb-3">
    <div class="col-md-12">
        @include('components.textaria', [
            'label' => 'Faça uma descrição:',
            'icon' => 'fas fa-comment',
            'type' => 'text',
            'name' => 'descricao',
            'placeholder' => 'Escreva uma descrição curta',
            'require' => true,
            'value' => old('descricao'),
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
            'disabled' => $disabled ?? false,
            'rows' => 3,
        ])
    </div>
</div>
