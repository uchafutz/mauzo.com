@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('View Role') }}</div>
                    <div class="card-body">
                        <div class="card card-primary">
                        
                            <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i>{{__("Role ")}}</strong>
                            <p class="text-muted">
                              <table class="table table-bordered">
                                <tr>
                                    <td>Name</td>
                                    <th>{{$role->name}}</th>
                                </tr>
                              </table>
                            </p>
                            <hr>
                            <strong><a class="btn btn-app">
                                <i class="fas fa-users"></i> {{__("Role Users")}}
                                </a></strong>
                            <p class="text-muted">
                                    @csrf
                                <table class="table table-bordered">
                                    @foreach ($role->users as $user)
                                      <tr>
                                        <th>{{$loop->iteration }}</th>
                                        <th>{{$user->name}}</th>
                                        <th>{{$user->email}}</th>
                                        </tr>
                                    @endforeach
                                  </table>
                                  
                                </form>
                            </p>
                            <hr>
                    
                            <strong><i class="fas fa-pencil-alt mr-1"></i>{{__("Permissions")}} <button type="submit" class="btn btn-primary">Update</button></strong>
                           
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
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$permission->display}}</td>
                                            <td><input class="form-check-input" name="" type="checkbox" value="{{$permission->id}}" id="flexCheckDefault" {{  (dd($role->permissions->role_id)==$role->id) ? ' checked' : '' }}></td>
                                        </tr>
                                    @endforeach
                              
                                </tbody>
                                </table>
                                </form>
                    
                            </div>
                            
                            </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection