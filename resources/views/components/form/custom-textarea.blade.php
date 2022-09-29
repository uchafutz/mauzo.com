<div class="form-group">
    <div class="col-md-6">
        <label for="{{ $name }}" class="label-control">{{ $label }}</label>
        <textarea name="{{ $name }}" class="form-control"
            placeholder="{{ $placeholder }} @error($name) is-invalid @enderror">{{ old($name) ?? $value }}</textarea>
    </div>
    @error($name)
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>
