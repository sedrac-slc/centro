<div class="row mt-1">
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Nome:',
            'icon' => 'fas fa-signature',
            'type' => 'text',
            'name' => 'nome',
            'placeholder' => 'Digita o nome do medicamento',
            'require' => true,
            'value' => $medicamento->nome ?? old('nome'),
        ])
    </div>
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Data Validade:',
            'icon' => 'fas fa-calendar',
            'type' => 'date',
            'name' => 'data_validade',
            'placeholder' => 'Digita a data validade',
            'require' => true,
            'value' => $medicamento->data_validade ?? old('data_validade'),
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
            'disabled' => $disabled ?? false,
        ])
    </div>
</div>
<div class="row mt-1">
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Quantidade mínimo:',
            'icon' => 'fas fa-signature',
            'type' => 'text',
            'name' => 'quantidade_minino_stock',
            'placeholder' => 'Digita a quantidade mínima',
            'require' => true,
            'value' => $medicamento->quantidade_minino_stock ?? old('quantidade_minino_stock'),
        ])
    </div>
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Quantidade estoque:',
            'icon' => 'fas fa-money-bill',
            'type' => 'number',
            'name' => 'quantidade_stock',
            'placeholder' => 'Digita a quantidade em estoque',
            'require' => true,
            'value' => $medicamento->quantidade_stock ?? old('quantidade_stock'),
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
            'disabled' => $disabled ?? false,
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
            'value' => $medicamento->descricao ?? old('descricao'),
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
            'disabled' => $disabled ?? false,
            'rows' => 3,
        ])
    </div>
</div>
