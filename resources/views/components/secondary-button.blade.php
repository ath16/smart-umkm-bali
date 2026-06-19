<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-6 py-3 bg-transparent border border-outline-dark rounded-heritage font-body text-body-sm font-semibold text-primary tracking-wide hover:bg-cream active:bg-surface-container-high focus:outline-none focus:ring-2 focus:ring-outline-dark/30 focus:ring-offset-2 transition ease-in-out duration-200']) }}>
    {{ $slot }}
</button>
