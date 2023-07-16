<div class="row">
    <div class="col-md-12">
        @include('components.input', [
            'label' => 'Farmacêutico:',
            'icon' => 'fas fa-user-md',
            'type' => 'text',
            'name' => 'farmaceutico_nome',
            'placeholder' => 'Digita o nome do farmacêutco',
            'require' => true,
            'value' => Auth::user()->name,
            'disabled' => true
        ])
    </div>
    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
</div>
<div class="row mt-1">
    <div class="col-md-12">
        @include('components.input', [
            'label' => 'Quantidade desejada:',
            'icon' => 'fas fa-list-ol',
            'type' => 'number',
            'name' => 'quantidade_desejada',
            'placeholder' => 'Digita a quantidade desejada',
            'require' => true,
            'value' => old('quantidade_desejada'),
            'min' => 0,
        ])
    </div>
</div>
<div class="row mt-1 pb-3">
    <div class="col-md-12">
        @include('components.input', [
            'label' => 'Medicamento:',
            'icon' => 'fas fa-user',
            'type' => 'text',
            'name' => 'medicamento_nome',
            'placeholder' => 'Digita o nome do medicamento',
            'require' => true,
            'value' => old('medicamento_nome'),
        ])
    </div>
    <div id="table-medicamento"></div>
</div>
