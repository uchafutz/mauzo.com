<div class="form-group">
        <label for="{{ $name }}" class="label-control">{{ $label }}</label>
        <input type="{{ $type }}" name="{{ $name }}"
            class="form-control @error($name) is-invalid @enderror" placeholder="{{ $placeholder }}"
            value="{{ old($name) ?? $value }}" {{ $attributes->whereStartsWith('x-') }} />
        @error($name)
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
</div>
