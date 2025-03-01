@props([
    'value',
    'required' => false,
])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
    @if ($required == true)
        <span class="text-red-500">*</span>
    @endif
</label>
