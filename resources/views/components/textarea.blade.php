<label for="{{ $id ?? ' ' }}" class="{{ $labelclass ?? '' }}">{{ $label ?? '' }}</label>
<textarea style="@error($name)
border:1px solid red; margin-bottom: 0%;
@enderror {{ $style ?? '' }}"
    id="{{ $id ?? '' }}" id="{{ $name }}" name="{{ $name }}" class="{{ $class ?? '' }}"
    rows="{{ $rows ?? 3 }}" placeholder="{{ $placeholder ?? '' }}">
@if ($id = 'curriculum')
{!! $value ?? old($name) !!}
@else
{{ $value ?? old($name) }}
@endif
</textarea>
@error($name)
    <p style="color: red; font-size: small; margin: 0%; padding: 0%;">{{ $message }}</p>
@enderror
