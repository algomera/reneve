@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-semibold text-sm text-gray-700 tracking-[0.5px]']) }}>
    {{ $value ?? $slot }}
</label>
