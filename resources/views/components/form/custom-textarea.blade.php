<div class="form-group">
    <label for="{{$name}}" class="label-control">{{ $label }}</label>
    <textarea name="{{$name}}" class="form-control" placeholder="{{$placeholder}} @error($name) is-invalid @enderror" >{{ old($name) ?? $value }}</textarea>
    @error($name) 
    <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>