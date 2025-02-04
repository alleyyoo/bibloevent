<div class="form-group">
    <label for="{{ $name }}">{{ $label ?? '' }}</label>
    <textarea
           name="{{ $name }}"
           id="{{ $name }}"
           class="form-control @error($name) is-invalid @enderror"
           placeholder="{{ $placeholder ?? $label ?? '' }}" rows="20"
           value="{{ old($name) ?? $value ?? $model->{$name} ?? '' }}"
            {{ $attribute ?? ''  }}
    ></textarea>
    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
