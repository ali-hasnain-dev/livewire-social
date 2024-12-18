@props([
    'type' => 'text',
    'name' => '',
    'label' => '',
    'placeholder' => '',
    'model' => '',
    'required' => false,
    'autofocus' => false,
    'disabled' => false,
    'readonly' => false,
    'error' => '',
])

<div class="flex flex-col gap-2">
    <label class="text-xs font-semibold" for="{{ $name }}">{{ $label }} @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
        class="w-full p-2 outline-none border {{ $error ? 'border-red-500' : 'border-gray-500' }} rounded-md dark:bg-slate-700"
        placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }} {{ $autofocus ? 'autofocus' : '' }}
        {{ $disabled ? 'disabled' : '' }} {{ $readonly ? 'readonly' : '' }} wire:model="{{ $model }}">
    <p class="text-red-500 text-xs">
        @if ($error)
            {{ $error }}
        @endif
    </p>
</div>
