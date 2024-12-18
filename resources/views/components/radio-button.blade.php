@props([
    'name' => '',
    'label' => '',
    'value' => '',
    'model' => '',
    'required' => false,
    'autofocus' => false,
    'disabled' => false,
    'readonly' => false,
    'error' => '',
])

<div class="flex items-center gap-4">
    <div class="flex items-center gap-2 cursor-pointer">
        <input type="radio" name="{{ $name }}" value="{{ $value }}" id="{{ $value }}"
            class="cursor-pointer" {{ $required ? 'required' : '' }} {{ $autofocus ? 'autofocus' : '' }}
            {{ $disabled ? 'disabled' : '' }} {{ $readonly ? 'readonly' : '' }} wire:model="{{ $model }}">
        <label for="{{ $value }}" class="cursor-pointer font-medium">{{ $label }}</label>
    </div>

</div>
