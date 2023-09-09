<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Models\Config\Organization;
use App\Models\Config\Unit;
use App\Models\Customer\Customer;
use App\Models\Inventory\InventoryItem;
use App\Models\Inventory\InventoryStockItem;
use App\Models\Inventory\InventoryWarehouse;
use App\Models\Sale\Sale;
use App\Models\Sale\SaleItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->is_admin) {
            $sales = Sale::all();
        }
        $sales = Sale::where('user_id', auth()->user()->id)->get();

        if (request()->wantsJson()) {
            return response([
                "data" => $sales
            ], 200);
        }
        return view("resources.sale.sales.index", compact("sales"));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();

        if (auth()->user()->is_admin) {
            $items = InventoryItem::with("stockItems.warehouse")->get();
        } else {
            $items = InventoryItem::with(["stockItems" => function ($query) {
                $query->where('inv_warehouse_id', auth()->user()->inventory_warehouse_id)
                    ->with('warehouse');
            }])->get();
        }

        $units = Unit::all();

        return view("resources.sale.sales.form", compact("customers", "items", "units"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    private function validateRequest(Request $request)
    {
        $messages = [];
        if ($request->input("items")) {
            foreach ($request->input('items') as $key => $val) {
                $position = $key + 1;
                $in_stock = $val["inv_stock_item_in_stock"];
                $messages["items.$key.quantity"] = "The item No #{$position} quantity must be less than or equal to {$in_stock}";
            }
        }

        Validator::make($request->input(), [
            "date" => ["required"],
            "return_amount" => ["required", "min:0"],
            "items" => ["required"],
            "items.*.inv_stock_item_in_stock" => ["required"],
            "items.*.quantity" => ["required", "lte:items.*.inv_stock_item_in_stock"],
        ], $messages)->validate();
    }

    public function store(Request $request)
    {

        // dd($request->all());
        $this->validateRequest($request);

        DB::beginTransaction();
        $sale = Sale::create($request->input());
        foreach ($request->input("items") as $item) {
            $saleItem = $sale->salesItems()->create($item);
            $saleItem->stockItems()->create([
                'stock_item_id' => $item["inv_stock_item_id"],
                'quantity' => $item["quantity"],
                'stock_item_snapshot' => json_encode(InventoryStockItem::find($item['inv_stock_item_id']))
            ]);
        }
        DB::commit();


        if (request()->wantsJson()) {
            return response(
                [
                    "data" => $sale
                ],
                201
            );
        }
        return redirect(route("sale.sales.index"));
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        $organization = Organization::first();
        if (request()->wantsJson()) {
            return response([
                "data" => $sale
            ], 200);
        }
        return view("resources.sale.sales.show", compact("sale", "organization"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        $customers = Customer::all();
        $items = InventoryItem::with("stockItems.warehouse")->get();
        $units = Unit::all();
        return view("resources.sale.sales.form", compact("customers", "items", "units", "sale"));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        // dd($request->all());
        // return redirect()->back();
        $this->validateRequest($request);
        DB::beginTransaction();
        $sale->update($request->input());
        foreach ($request->input("items") as $item) {
            if ($item["id"]) {
                $saleItem = SaleItem::find($item['id']);
                $saleItem->update($item);
                $saleItem->stockItems()->delete();
                $saleItem->stockItems()->create([
                    'stock_item_id' => $item["inv_stock_item_id"],
                    'quantity' => $item["quantity"],
                    'stock_item_snapshot' => json_encode(InventoryStockItem::find($item['inv_stock_item_id']))
                ]);
            } else {
                $saleItem = $sale->salesItems()->create($item);
                $saleItem->stockItems()->create([
                    'stock_item_id' => $item["inv_stock_item_id"],
                    'quantity' => $item["quantity"],
                    'stock_item_snapshot' => json_encode(InventoryStockItem::find($item['inv_stock_item_id']))
                ]);
            }
        }
        DB::commit();

        if (request()->wantsJson()) {
            return response(
                [
                    "data" => $sale
                ],
                201
            );
        }
        return redirect(route("sale.sales.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        if (request()->wantsJson()) {
            return response(null, 204);
        }
        return redirect(route("sale.sales.index"));
        //
    }
}
