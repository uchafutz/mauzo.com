@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('View User') }}</div>
                    <div class="card-body">
                        <div class="card card-primary">
                        
                            <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i>{{__("User Details")}}</strong>
                            <p class="text-muted">
                              <table class="table table-bordered">
                                <tr>
                                    <td>Name</td>
                                    <th>{{$role->name}}</th>
                                </tr>
                              </table>
                            </p>
                            <hr>
                            <strong><a class="btn btn-app" href="{{ route("config.roles.create") }}">
                                <i class="fas fa-plus"></i> New Users
                                </a></strong>
                            <p class="text-muted">
                                    @csrf
                                <table class="table table-bordered">
                                    @foreach ($role->users as $role)
                                      <tr>
                                        <th>{{$loop->iteration }}</th>
                                        <th>{{$role->name}}</th>
                                        <th>{{$role->email}}</th>
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

                                    @foreach ($role->permissions as $role)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                             <td>{{$role->display}}</td>
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