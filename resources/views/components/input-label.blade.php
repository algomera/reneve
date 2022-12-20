@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-extrabold uppercase text-[11px] text-[#ABB1B1] tracking-[.75px]']) }}>
    {{ $value ?? $slot }}
</label>
