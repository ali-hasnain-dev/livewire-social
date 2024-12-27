@props([
    'name' => '',
    'label' => '',
    'placeholder' => '',
    'model' => '',
    'required' => false,
    'autofocus' => false,
    'disabled' => false,
    'readonly' => false,
    'error' => '',
    'rows' => 5,
    'resized' => true,
    'showCounter' => false,
])

<div class="flex flex-col gap-2">
    <label class="text-xs font-semibold" for="{{ $name }}">{{ $label }} @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
    <textarea name="{{ $name }}" id="{{ $name }}"
        class="w-full p-2 outline-none border text-sm font-normal {{ $error ? 'border-red-500' : 'border-slate-200 dark:border-slate-700' }} rounded-md dark:bg-slate-900 shadow placeholder:italic"
        placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }} {{ $autofocus ? 'autofocus' : '' }}
        {{ $disabled ? 'disabled' : '' }} {{ $readonly ? 'readonly' : '' }} wire:model="{{ $model }}"
        rows="{{ $rows }}" style="resize: none;">
    </textarea>
    <p class="text-red-500 text-xs">
        @if ($error)
            {{ $error }}
        @endif
    </p>
</div>
