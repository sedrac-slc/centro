<div class="row mt-1 pb-3">
    <div class="col-md-4">
        @include('components.input', [
            'label' => 'Nota(primeira):',
            'icon' => 'fas text-yellow fa-list',
            'type' => 'number',
            'name' => 'nota_primeira',
            'min' => 0,
            'placeholder' => '',
            'require' => true,
            'value' => $nota->nota_primeira ?? old('nota_primeira'),
        ])
    </div>
    <div class="col-md-4">
        @include('components.input', [
            'label' => 'Nota(segunda):',
            'icon' => 'fas text-yellow fa-list',
            'type' => 'number',
            'name' => 'nota_segunda',
            'min' => 0,
            'placeholder' => '',
            'require' => true,
            'value' => $nota->nota_segunda ?? old('nota_segunda'),
        ])
    </div>
    <div class="col-md-4">
        @include('components.input', [
            'label' => 'Nota(Terceira):',
            'icon' => 'fas text-yellow fa-list',
            'type' => 'number',
            'name' => 'nota_terceira',
            'min' => 0,
            'placeholder' => '',
            'require' => true,
            'value' => $nota->nota_terceira ?? old('nota_terceira'),
        ])
    </div>
</div>
