@props([
    'name' => '',
    'label' => '',
    'value' => '',
    'required' => false,
    'autofocus' => false,
    'disabled' => false,
    'readonly' => false,
    'error' => '',
])

<div class="flex items-center gap-4">
    <div class="flex items-center gap-2 cursor-pointer">
        <input type="radio" name="{{ $name }}" value="{{ $value }}" id="{{ $name }}"
            class="cursor-pointer" {{ $required ? 'required' : '' }} {{ $autofocus ? 'autofocus' : '' }}
            {{ $disabled ? 'disabled' : '' }} {{ $readonly ? 'readonly' : '' }} wire:model="{{ $name }}">
        <label for="{{ $name }}" class="cursor-pointer font-medium">{{ $label }}</label>
    </div>
</div>
