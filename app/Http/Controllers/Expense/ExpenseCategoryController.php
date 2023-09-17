<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use App\Models\Expense\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ExpenseCategory::all();
        return view('resources.expense.category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('resources.expense.category.form');
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
            "category_name" => ['required', 'unique:expense_categories,category_name']
        ]);
        ExpenseCategory::create($request->input());
        return redirect(route("expense.expenseCategories.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense\ExpenseCategory  $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ExpenseCategory $expenseCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense\ExpenseCategory  $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpenseCategory $expenseCategory)
    {
        // dd($expenseCategory);
        return view("resources.expense.category.form", ['category' => $expenseCategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense\ExpenseCategory  $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpenseCategory $expenseCategory)
    {
        $request->validate([
            "category_name" => ['required', 'unique:expense_categories,category_name']
        ]);

        $expenseCategory->update($request->input());
        
        return redirect(route("expense.expenseCategories.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense\ExpenseCategory  $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpenseCategory $expenseCategory)
    {
        $expenseCategory->delete();
        return redirect(route("expense.expenseCategories.index"));
    }
}
