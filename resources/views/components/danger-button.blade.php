<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-3 bg-error border border-transparent rounded-heritage font-body text-body-sm font-semibold text-white tracking-wide hover:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-error/30 focus:ring-offset-2 transition ease-in-out duration-200']) }}>
    {{ $slot }}
</button>
