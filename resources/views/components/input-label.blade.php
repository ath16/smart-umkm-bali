@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-body text-body-sm font-semibold text-text-primary']) }}>
    {{ $value ?? $slot }}
</label>
