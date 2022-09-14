@extends('layouts.app')

@section('content')
<div class="container">
 <div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">{{ __('Add Role') }}</div>
       <div class="card-body">
                       
         @isset($role)
           <form action="{{ route("config.roles.update", ["role" => $role]) }}" method="POST" enctype="multipart/form-data">
            @method("patch")
             @else
          <form action="{{ route("config.roles.store") }}" method="POST" enctype="multipart/form-data">
           @endisset
                        
             @csrf
    <x-form.custom-input name="name" type="text" label="Name" placeholder="Name" value="{{ isset($role) ? $role->name : null }}"/>
    <x-form.custom-input name="display" type="text" label="Display" placeholder="" value="{{ isset($role) ? $role->display : null }}"/>
        <x-form.custom-textarea name="description" label="Description" placeholder="Description" value="{{ isset($role) ? $role->description : null }}"/>
        <br/>
                           

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</div>
</div>
</div>
</div>
@endsection