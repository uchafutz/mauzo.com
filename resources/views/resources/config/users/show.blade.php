@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
               
                        <div class="card card-primary">
                        
                            <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i>{{__("User Details")}}</strong>
                            <p class="text-muted">
                              <table class="table table-bordered">
                                <tr>
                                    <td>Name</td>
                                    <td>{{$user->name}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{$user->email}}</td>
                                </tr>
                              </table>
                            </p>
                            <hr>
                            <strong><a class="btn btn-app" href="{{ route("config.roles.create") }}">
                                <i class="fas fa-plus"></i> New Role
                                </a></strong>
                            <p class="text-muted">
                                <form action="{{ route("config.users.assignRoles", ["user" => $user]) }}" method="post">
                                    @csrf
                                <table class="table table-bordered pull-right" style="width: 100% !important;" align="right">
                                    @foreach ($roles as $role)
                                      <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <th>{{$role->display}}</th>
                                        <th><input class="form-check-input" name="role_id[]" type="checkbox" value="{{$role->id}}" id="flexCheckDefault" {{  ($user->roles->contains('name', $role->name) ? ' checked' : '') }}></th>
                                        </tr>
                                    @endforeach
                                    <th colspan="3" ><button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-sync"></i> Update</button></th>
                                  </table>
                                  
                                  
                                 
                                </form>
                            </p>
                            <hr>
                            
                            <form action="{{ route("config.users.assignPermissions", ["user" => $user]) }}" method="post">
                            <strong><i class="fas fa-pencil-alt mr-1"></i>{{__("Permissions")}}</strong>
                           
                            <hr>
                            <div class="card-body">
                                
                                    @csrf
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <th>S/n</th>
                                    <th>Permission Name</th>
                                    <th> Access</th>
                                </thead>
                                <tbody>
                                @foreach ($permissions as $permission)
                                <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $permission->display}}</td>
                                <td><input class="form-check-input" name="permission_id[]" type="checkbox" value="{{$permission->id}}" id="flexCheckDefault" {{  ($user->permissions->contains('name', $permission->name) ? ' checked' : '') }}></td>
                                </tr>
                                @endforeach
                                <th colspan="3"> <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-sync"></i> Update</button></th>
                                </tbody>
                                </table>
                                </form>
                    
                            </div>
                            
                  
            </div>
        </div>
    </div>
@endsection