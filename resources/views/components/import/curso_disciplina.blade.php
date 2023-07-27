<div class="row">
    <div class="col-md-12">
        @include('components.input', [
            'label' => 'Curso:',
            'icon' => 'fas fa-signature',
            'type' => 'text',
            'name' => 'nome',
            'placeholder' => 'Digita o curso',
            'require' => true,
            'value' => old('curso'),
        ])
    </div>
</div>
<div class="row mt-1 pb-3">
    <div class="col-md-12">
        @include('components.input', [
            'label' => 'Disciplina:',
            'icon' => 'fas fa-signature',
            'type' => 'text',
            'name' => 'disciplina',
            'placeholder' => 'Digita o disciplina',
            'require' => true,
            'value' => old('disciplina'),
        ])
    </div>
</div>
