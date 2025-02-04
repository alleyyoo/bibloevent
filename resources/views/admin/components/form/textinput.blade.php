<div class="form-group">
    <label for="{{ $name }}">{{ $label ?? '' }}</label>
    <input type="text"
           name="{{ $name }}"
           id="{{ $name }}"
           class="form-control @error($name) is-invalid @enderror"
           placeholder="{{ $placeholder ?? $label ?? '' }}"
           value="{{ old($name) ?? $value ?? $model->{$name} ?? '' }}"
           {{ $attribute ?? ''  }}
    >
    @error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
