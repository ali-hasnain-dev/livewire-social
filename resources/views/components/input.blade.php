@props([
    'type' => 'text',
    'name' => '',
    'label' => '',
    'placeholder' => '',
    'value' => '',
    'required' => false,
    'autofocus' => false,
    'disabled' => false,
    'readonly' => false,
    'error' => '',
])

<div class="flex flex-col gap-2">
    <label class="text-xs font-semibold" for="{{ $name }}">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
        class="w-full p-2 outline-none border {{ $error ? 'border-red-500' : 'border-gray-500' }} rounded-md dark:bg-slate-700"
        placeholder="{{ $placeholder }}" value="{{ $value }}" {{ $required ? 'required' : '' }}
        {{ $autofocus ? 'autofocus' : '' }} {{ $disabled ? 'disabled' : '' }} {{ $readonly ? 'readonly' : '' }}
        wire:model="{{ $name }}">
    <p class="text-red-500 text-xs">
        @if ($error)
            {{ $error }}
        @endif
    </p>
</div>
