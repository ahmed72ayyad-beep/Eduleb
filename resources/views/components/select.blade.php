@props(['label' => null, 'labelclass' => ''])

@if ($label)
    <label class="{{ $labelclass }}">{{ $label }}</label>
@endif

<select
    {{ $attributes->merge(['class' => 'w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500/20 text-sm']) }}>
    {{ $slot }}
</select>
