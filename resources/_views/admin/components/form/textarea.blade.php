<div class="form-group">
    <label for="{{ $name }}">{{ $label ?? '' }}</label>
    <textarea name="{{ $name }}"
           id="{{ $name }}"
           rows="4" 
           class="form-control @error($name) is-invalid @enderror"
           placeholder="{{ $placeholder ?? $label ?? '' }}"
           {{ $attribute ?? ''  }}
    >{{ old($name) ?? $model->{$name} ?? '' }}</textarea>
    @error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
