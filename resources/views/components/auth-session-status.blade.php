@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-body text-body-sm text-accent-teal bg-accent-teal/10 border border-accent-teal/20 rounded-heritage px-4 py-3']) }}>
        {{ $status }}
    </div>
@endif
