@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-outline rounded-heritage bg-surface-white text-text-primary text-body-sm placeholder:text-on-surface-variant/50 focus:border-outline-dark focus:ring focus:ring-outline-dark/10 transition-colors disabled:bg-surface-dim disabled:cursor-not-allowed']) }}>
