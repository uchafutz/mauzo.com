@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('New Purchase') }}</div>
                    <div class="card-body">
                       
                        <form class="row g-3" action="{{ route("purchase.purchases.store") }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6">
                              <label for="inputEmail" class="form-label">Code</label>
                              <input type="text" name="code" class="form-control" id="inputEmail4">
                            </div>
                            <div class="col-md-6">
                              <label for="inputPassword4" class="form-label">Date</label>
                              <input type="date" name="date" class="form-control" id="inputPassword4">
                            </div>
                            <div class="col-12">
                                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <table  id="receive" class="table table-bordered">
                                <tr>
                                   <th>S/n</th>
                                   <th>Item</th>
                                   <th>Unit</th>
                                   <th>Quantity</th>
                                   <th>Unit Amount</th>
                                   <th>Amount</th>
                                   <th></th>
                                </tr>  
                                <tbody>
                                    <tr class="dubplicate_row">
                                        <td>1</td>
                                        <td>
                                            <input type="text" name="inv_items_id_a[]" id="name[]" list="items" autocomplete="off" placeholder="Item Name" class="  name border form-control" value="" required="">
                                            <input type="hidden" name="inv_items_id[]" class="item_name">
                                            </td>
                                        <td>
                                        <input  type="text" name="conf_units_id_A[]" id="conf_units_id[]" placeholder="Unit" list="measure" autocomplete="off" class="  unit border form-control" value="" required="">
                                        <input type="hidden" name="conf_units_id[]" class="item_unit">
                                            </td>
                                            <td >
                                                <input type="text" name="quantity[]" id="name[]" placeholder="Quantinty" class="quantity border form-control" value="" required="">
                        
                                                </td>
                                            <td >
                                            <input  type="text" name="" id="" placeholder="Unit Amount" class="unit_amount border form-control" value="" required="">
                                            </td>
                                            <td >
                                            <input  type="text" name="amount[]" id="amount[]" placeholder="Amount" class="amount border form-control" value="" readonly>
                            
                                            </td>

                                        <td  class="clickable">
                                          <div class="btn-group" role="group" aria-label="default">
                                            <input type="button" class="btn btn-primary btn-act tr_clone_add" value=" + ">
                                            <input type="button" class="btn btn-danger btn-act tr_clone_remove" value=" x ">
                                          </div> 
                                        </td>
                                    </tr>
                                    <tr class="d-grid gap-2">
                                        <td colspan="6" >
                                            <button  type="submit" id="" class="btn btn-primary">Submit</button>
                                        </td>
                                    </tr>
                                </tbody>
                                
                            </table>
                        

                          </form>
                          <table class="table table-bordered pull-right" style="width: 40% !important;" align="right">
                           <tr>
                            <td><h6 >TOTAL</h6></td>
                            <td class="total_display">.00</td>
                           </tr>
                           
                           

                          </table>
                          <datalist id="items">
                            @foreach ($items as $item)
                            <option data-value="{{$item->id}}" value="{{$item->name}}">{{$item->name}}</option>
                            @endforeach
                         
                          </datalist>
                          <datalist id="measure">
                            @foreach ($units as $unit)
                            <option data-value="{{$unit->id}}" value="{{$unit->name}}">{{$unit->name}}</option>
                            @endforeach
                          </datalist>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).on('input','.name', function(){
            var opt = $('#items option[value="'+$(this).val()+'"]');
            var v = opt.length ? opt.attr('data-value') : '';
            $(this).parent().find(".item_name").val(v);
        });

        $(document).on('input','.unit', function(){
            measure(this);
        });

        $(document).on('mouse-down','.unit', function(){
            measure(this);
        });

        function measure(element){
            var opt = $('#measure option[value="'+$(element).val()+'"]');
            var v = opt.length ? opt.attr('data-value') : '';
            $(element).parent().find(".item_unit").val(v);
        }

        $(document).on('input','.quantity', function(){
            total(this);
        }); 
        
        $(document).on('input','.unit_amount', function(){
            total(this);
        }); 
        $(document).on('click','.tr_clone_remove', function(){
            displayTotal();
        }); 
        $(document).on('click','.tr_clone_add', function(){
            displayTotal();
        }); 

        function total(element){
            var quantity = floatParser($(element).parent().parent().find("td .quantity").val());
            var unit_amount = floatParser($(element).parent().parent().find("td .unit_amount").val());
            $(element).parent().parent().find("td .amount").val(quantity*unit_amount);
            displayTotal();
        }

        function floatParser(amount){
            var res = 0;
            try{
                res = parseFloat(amount);
            }catch(e){
                res = 0;
            }
            return isNaN(res) ? 0 : res;
        }

        function displayTotal(){
            var total = 0;
            $(".amount").each(amount => {
                total += floatParser($(".amount")[amount].value);
            });
            $(".total_display").text(total);
        }
    </script>
@endsection