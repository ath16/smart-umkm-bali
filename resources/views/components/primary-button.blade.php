<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-3 bg-primary border border-transparent rounded-heritage font-body text-body-sm font-semibold text-white tracking-wide hover:bg-primary-dark active:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary/30 focus:ring-offset-2 transition ease-in-out duration-200']) }}>
    {{ $slot }}
</button>
