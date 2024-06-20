<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Models\Account\Account;
use App\Models\Account\AccountLedger;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts=Account::paginate(10);
        if(request()->wantsJson()){
            return response(["data"=>$accounts]);
        }
        return view("resources.account.index",compact("accounts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounts=Account::all();
        return view("resources.account.ledgers.form",compact("accounts"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAccountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccountRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
       $accountLegders=AccountLedger::where("account_id",$account->account_owner)->get();
       if(request()->wantsJson()){
        return response(["data"=>["account"=>$account,"acountLegders"=>$accountLegders]],200);
       }
       return view("resources.account.show",compact("account","accountLegders"));
      // dd($accountLegders);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAccountRequest  $request
     * @param  \App\Models\Account\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountRequest $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
    }
}
