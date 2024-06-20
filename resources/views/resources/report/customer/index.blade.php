@extends('layouts.app')

@section('page_title')
    
        Customers Report
  
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                      
                            <form class="row g-3"
                                action="{{ route('report.customers.create')}}"
                                method="POST" enctype="multipart/form-data">
                              
                                @csrf
                                <input type="hidden" name="operation_id" value="{{ Auth::user()->id }}" required>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="" class="label-control">Customer</label>
                                            <select name="customer_id"  class="form-control @error('customer_id') is-invalid @enderror">
                                               <option value="">Choose Customer</option>
                                               @foreach ($customers as $customer)
                                                   <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                               @endforeach           
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                           <x-form.custom-input type="date" name="from" label="From Sales Date"
                                                value="{{  date('Y-m-d') }}" />
                                        </div>
                                        <div class="col-md-4">
                                            <x-form.custom-input type="date" name="to" label="To Sales Date"
                                                value="{{ date('Y-m-d') }}" />
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-lg btn-success">Shop report</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
