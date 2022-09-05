@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('View Inventory Item') }}</div>
                    <div class="card-body">
                       <p>{{$inventoryItem->name}}</p>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection