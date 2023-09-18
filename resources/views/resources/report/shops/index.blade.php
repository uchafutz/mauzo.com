@extends('layouts.app')

@section('page_title')
    
        Shops Report
  
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                      
                            <form class="row g-3"
                                action="{{ route('report.shops.create')}}"
                                method="POST" enctype="multipart/form-data">
                              
                                @csrf
                                <input type="hidden" name="operation_id" value="{{ Auth::user()->id }}" required>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="" class="label-control">Shop</label>
                                            <select name="shop_id"  class="form-control @error('type') is-invalid @enderror">
                                               <option value="">Choose shop</option>
                                               @foreach ($shops as $shop)
                                                   <option value="{{ $shop->id }}">{{ $shop->name }}</option>
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
