<?php

namespace App\Http\Controllers\Account;

use App\Enum\AccountStatusEnum;
use App\Enum\AccountTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccountLedgerRequest;
use App\Http\Requests\UpdateAccountLedgerRequest;
use App\Models\Account\Account;
use App\Models\Account\AccountLedger;
use Exception;
use Illuminate\Support\Facades\Auth;

class AccountLedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accountLedgers= AccountLedger::paginate(10);
       // dd($accountLedgers);
        if(request()->wantsJson()){
            return response(["data"=>$accountLedgers],200);
        }
        return view( "resources.account.ledgers.index",compact("accountLedgers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounts=Account::all();
        $operations=AccountTypeEnum::cases();
      //  dd($operations);
        return view("resources.account.ledgers.form",compact("accounts","operations"));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAccountLedgerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccountLedgerRequest $request)
    {
        $data=$request->validated();
        if($data["type"]===AccountTypeEnum::DEBIT_AMOUNT->value){
            $account=Account::where("account_owner",$data["account_id"])->first();
            if (!$account) {
                throw new Exception("Account not found for customer ID: " . $data["account_id"]);
            }
            $balance_intial = $account->balance - $data["amount"];
            $balance=$account->initial_balance + $data["amount"];
            $account->update(["balance"=>$balance_intial,"initial_balance"=>$balance]);
            $value=[
                "account_id"=>$data["account_id"],
                "description"=>$data["description"], 
                "amount"=>$data["amount"],
                "debit"=>AccountTypeEnum::DEBIT_AMOUNT->value,
                "user_id" =>Auth::user()->id
                
            ];
            AccountLedger::create($value);

        }elseif($data["type"]===AccountTypeEnum::CREDIT_AMOUNT->value){
            $account=Account::where("account_owner",$data["account_id"])->first();
            if (!$account) {
                throw new Exception("Account not found for customer ID: " . $data["account_id"]);
            }
           $balance = $account->balance + $data["amount"];
           $account->update(["balance" => $balance]);
       
            $value=[
                "account_id"=>$data["account_id"],
                "description"=>$data["description"], 
                "amount"=>$data["amount"],
                "credit"=>AccountTypeEnum::CREDIT_AMOUNT->value,
                "user_id" =>Auth::user()->id
                
            ];
            AccountLedger::create($value);

        }else{
            throw new Exception("Account not found for customer ID: " . $data["account_id"]);
        }
        return redirect()->route("account.accountLedgers.index");
        //dd($data);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account\AccountLedger  $accountLedger
     * @return \Illuminate\Http\Response
     */
    public function show(AccountLedger $accountLedger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account\AccountLedger  $accountLedger
     * @return \Illuminate\Http\Response
     */
    public function edit(AccountLedger $accountLedger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAccountLedgerRequest  $request
     * @param  \App\Models\Account\AccountLedger  $accountLedger
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountLedgerRequest $request, AccountLedger $accountLedger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account\AccountLedger  $accountLedger
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountLedger $accountLedger)
    {
        //
    }
}
