@extends('layouts.app')

@section('page_title')
    
        Purchase Report
  
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                      
                            <form class="row g-3"
                                action="{{ route('report.create')}}"
                                method="POST" enctype="multipart/form-data">
                              
                                @csrf
                                <input type="hidden" name="operation_id" value="{{ Auth::user()->id }}" required>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-4 mb-2">
                                         <label for="" class="label-control">Select Vendor</label>
                                         <select class="form-control" name="vendor_id">
                                         <option value="">Choose Vendor...</option>
                                        @foreach ($vendors as $vendor)
                                             <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                        @endforeach
                                       
                                        </select>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                           <x-form.custom-input type="date" name="from" label="From Purchase Date"
                                                value="{{  date('Y-m-d') }}" />
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <x-form.custom-input type="date" name="to" label="To Purchase Date"
                                                value="{{ date('Y-m-d') }}" />
                                        </div>
                                    </div>
                                </div>

                             


                                    <button type="submit" class="btn btn-lg btn-primary">Generate Report of Purchase</button>
                             
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
