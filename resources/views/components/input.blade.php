@if (isset($label))
    <label class="{{ $labelclass ?? '' }}" for="{{ $id ?? '' }}">{{ __("site.$label") ?? '' }}
        <br>
        <small style=" {{ $spicialmsgstyle ?? '' }} " class="{{ $spicialmsgclass ?? '' }}">{{ $spicialmsg ?? '' }}</small>
    </label>
@endif
<input multiple="{{ $multiple ?? '' }}" class="{{ $class ?? '' }}"
    style="@error($name)
border:1px solid red; margin-bottom: 0%;
@enderror" id="{{ $id ?? '' }}"
    type="{{ $type ?? 'text' }}" name="{{ $name }}" placeholder="{{ $placeholder ?? ' ' }}"
    value="{{ $value ?? old($name) }}" />
{{-- @dump(old($name)) --}}

@error($name)
    <p style="color: red; font-size: smaller; margin: 0%; padding: 0%;">{{ $message }}</p>
@enderror

@if (isset($type) && $type == 'file' && isset($value))
    <div class="mt-2 flex items-center gap-3 p-2 bg-slate-50 rounded-2xl border border-slate-100 w-fit">
        <img src="{{ asset($value) }}" alt="Current Image"
            class="w-16 h-12 object-cover rounded-xl border border-gray-200 shadow-xs">
    </div>
@endif
