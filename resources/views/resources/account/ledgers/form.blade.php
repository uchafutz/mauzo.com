@extends('layouts.app')
@section('page_title')
    @isset($accountLedger)
        Update Transaction
    @else
        New  Transaction
    @endisset
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> </div>

                    <div class="card-body">

                        @isset($accountLedger)
                            <form action="{{ route('account.accountLedgers.update', ['accountLedger' => $accountLedger]) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('PUT')
                            @else
                                <form action="{{ route('account.accountLedgers.store') }}" method="POST" enctype="multipart/form-data">
                                @endisset

                                @csrf
                                    <div class="form-group">
                                        <label for="" class="label-control">Select Customer Account</label>
                                        <select name="account_id"
                                            class="form-control @error('account_id') is-invalid @enderror">
                                         @foreach ($accounts as $account)
                                             <option value={{$account->account_owner}}>{{$account->account_name}}</option>
                                         @endforeach
                                          
                                        </select>
                                    @error('account_id')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                        <label for="" class="label-control">Opreation Method</label>
                                        <select name="type"
                                            class="form-control @error('type') is-invalid @enderror">
                                         @foreach ($operations as $operation)
                                             <option value={{$operation->value}}>{{$operation->name}}</option>
                                         @endforeach
                                          
                                        </select>
                                    @error('type')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                              
                               <x-form.custom-input name="amount" type="number" label="Amount" placeholder="Amount"
                                    value="{{ isset($accountLedger) ? $accountLedger->amount : null }}" />
                                <x-form.custom-textarea name="description" label="Description" placeholder="Description"
                                    value="{{ isset($accountLedger) ? $accountLedger->description : null }}" />

                                <br />
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
