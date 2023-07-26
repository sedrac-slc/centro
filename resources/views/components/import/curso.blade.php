<div class="row">
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
            'label' => 'Sala:',
            'icon' => 'fas fa-bars',
            'type' => 'number',
            'name' => 'sala',
            'placeholder' => 'Digita a sala',
            'value' => old('sala'),
        ])
    </div>
</div>
<div class="row mt-1 pb-3">
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Data(começo):',
            'icon' => 'fas fa-calendar',
            'type' => 'date',
            'name' => 'data_inicio',
            'placeholder' => 'Digita a data começo',
            'require' => true,
            'value' => old('data_inicio'),
        ])
    </div>
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Data(termino):',
            'icon' => 'fas fa-calendar-time',
            'type' => 'date',
            'name' => 'data_termino',
            'placeholder' => 'Digita a data termino',
            'require' => true,
            'value' => old('data_termino'),
        ])
    </div>
</div>
<div class="row mt-1 pb-3">
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Hora(começo):',
            'icon' => 'fas fa-calendar',
            'type' => 'time',
            'name' => 'hora_entrada',
            'placeholder' => 'Digita a hora começo',
            'require' => true,
            'value' => old('hora_entrada'),
        ])
    </div>
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Hora(termino):',
            'icon' => 'fas fa-calendar-time',
            'type' => 'time',
            'name' => 'hora_termino',
            'placeholder' => 'Digita a hora termino',
            'require' => true,
            'value' => old('hora_termino'),
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
