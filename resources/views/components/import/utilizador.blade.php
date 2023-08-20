@php use App\Utils\UserUtil; @endphp
<div class="row mt-1">
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Nome(completo):',
            'icon' => 'fas fa-signature',
            'type' => 'text',
            'name' => 'name',
            'placeholder' => 'Digita o seu nome completo',
            'require' => true,
            'value' => $user->name ?? '',
            'inline' => $inline ?? false,
            'disabled' => $disabled ?? false,
        ])
    </div>
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Email:',
            'icon' => 'fas fa-envelope',
            'type' => 'email',
            'name' => 'email',
            'placeholder' => 'Digita o seu email',
            'require' => true,
            'value' => $user->email ?? '',
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
            'disabled' => $disabled ?? false,
        ])
    </div>
</div>
<div class="row mt-1">
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Data nascimento:',
            'icon' => 'fas fa-calendar',
            'type' => 'date',
            'name' => 'birthday',
            'placeholder' => 'Digita o sua data nascimento',
            'require' => true,
            'value' => $user->birthday ?? '',
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
            'disabled' => $disabled ?? false,
        ])
    </div>
    <div class="col-md-6">
        @include('components.select', [
            'label' => 'Gênero:',
            'icon' => 'fas fa-venus-mars',
            'name' => 'gender',
            'require' => true,
            'list' => UserUtil::genders(),
            'init' => $user->gender ?? '',
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
        ])
    </div>
</div>
<div class="row mt-1 pb-3">
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Telefone:',
            'icon' => 'fas fa-phone',
            'type' => 'text',
            'name' => 'phone',
            'placeholder' => 'Digita o seu telefone',
            'require' => true,
            'value' => $user->phone ?? '',
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
            'disabled' => $disabled ?? false,
        ])
    </div>
    <div class="col-md-6">
        @if (isset($user_tipo) && $user_tipo != '')
            @include('components.input', [
                'label' => 'Ocupação:',
                'icon' => 'fas fa-user-secret',
                'name' => 'tipo',
                'require' => true,
                'value' => $user_tipo,
                'rounded' => $rounded ?? false,
                'inline' => $inline ?? false,
                'disabled' => true,
            ])
        @else
            @include('components.select', [
                'label' => 'Ocupação:',
                'icon' => 'fas fa-user-secret',
                'name' => 'tipo',
                'require' => true,
                'list' => UserUtil::tipos(),
                'init' => $user->tipo ?? '',
                'rounded' => $rounded ?? false,
                'inline' => $inline ?? false,
                'disabled' => isset($funcionario_readonly),
            ])
        @endif
    </div>
</div>
@if (!isset($password_hidden))
    <div class="row  pb-2 pt-2 border-top" id="password-input">
        <div class="col-md-6">
            @include('components.input', [
                'label' => 'Senha:',
                'icon' => 'fas fa-lock',
                'type' => 'password',
                'name' => 'password',
                'placeholder' => 'Digita a sua senha',
                'require' => true,
                'rounded' => $rounded ?? false,
                'inline' => $inline ?? false,
                'disabled' => $disabled ?? false,
            ])
        </div>
        <div class="col-md-6">
            @include('components.input', [
                'label' => 'Confirma(senha):',
                'icon' => 'fas fa-key',
                'type' => 'password',
                'name' => 'password_confirmation',
                'placeholder' => 'Confirma a sua senha',
                'require' => true,
                'rounded' => $rounded ?? false,
                'inline' => $inline ?? false,
                'disabled' => $disabled ?? false,
            ])
        </div>
    </div>
@endif
