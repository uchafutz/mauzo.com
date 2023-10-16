<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use App\Models\Expense\Expense;
use App\Models\Expense\ExpenseCategory;
use App\Models\Inventory\InventoryWarehouse;
use App\Models\Sale\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::with(['expenseCategory','user', 'inventoryWarehouse'])->get();


        return view('resources.expense.expense.index', ['expenses' => $expenses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ExpenseCategory::all();
        if (Auth::user()->is_admin) {
            # code...
        $warehouses = InventoryWarehouse::all();

        }else{
            $warehouses = InventoryWarehouse::where('id', Auth::user()->inventory_warehouse_id)->get();
        }
        return view('resources.expense.expense.form', ['categories' => $categories, 'warehouses' => $warehouses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "expense_category_id" => ['required'],
            "amount" => ['required']
        ]);
        // Expense::create($request->input());
        $expense = new Expense();
        $expense->expense_category_id = $request->expense_category_id;
        $expense->inventory_warehouse_id = $request->inventory_warehouse_id;
        $expense->amount = $request->amount;
        $expense->type = $request->type;
        $expense->description = $request->description;
        $expense->user_id = auth()->user()->id;
        $expense->save();

        return redirect(route("expense.expenses.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        return view('resources.expense.expense.show', ['expense'=>$expense]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        //
    }
}
