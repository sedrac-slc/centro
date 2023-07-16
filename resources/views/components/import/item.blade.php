<div class="row">
    <div class="col-md-12">
        @include('components.input', [
            'label' => 'Medicamento:',
            'icon' => 'fas fa-hospital',
            'type' => 'text',
            'name' => 'medicamento_nome',
            'placeholder' => 'Digita o nome do medicamento',
            'require' => true,
            'value' => $medicamento->nome ?? old('medicamento'),
            'readonly' => isset($medicamento)
        ])
    </div>
    @isset($route)
        <input type="hidden" name="medicamento_id" id="medicamento_key">
    @else
        @isset($medicamento)
            <input type="hidden" name="medicamento_id" id="" value="{{ $medicamento->id }}">
        @else
            <div id="table-medicamento"></div>
        @endisset
    @endisset
</div>
<hr/>
<div class="row mt-1 pb-3">
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Código:',
            'icon' => 'fas fa-signature',
            'type' => 'text',
            'name' => 'codigo',
            'placeholder' => 'Digita o código do medicamento',
            'require' => true,
            'value' => old('codigo'),
        ])
    </div>
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Data válidade:',
            'icon' => 'fas fa-calendar',
            'type' => 'date',
            'name' => 'data_validade',
            'placeholder' => 'Digita a data válidade',
            'require' => true,
            'value' => old('data_validade'),
        ])
    </div>
</div>
