@extends('layouts.app')

@section('page_title')
    
        Sales Report
  
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                      
                            <form class="row g-3"
                                action="{{ route('report.sales.create')}}"
                                method="POST" enctype="multipart/form-data">
                              
                                @csrf
                                <input type="hidden" name="operation_id" value="{{ Auth::user()->id }}" required>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="" class="label-control">Vendor Type</label>
                                            <select name="vendor_type"  class="form-control @error('type') is-invalid @enderror">
                                               <option value="">Choose vendor</option>
                                               <option value="Local Vendor">Local Vendor</option>
                                               <option value="International Vendor">International Vendor</option>                
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
                                <button type="submit" class="btn btn-lg btn-success">Report of Sales</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
