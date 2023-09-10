<!DOCTYPE html>
<html>
<head>
    <title>Purchase Report</title>
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
    
    <link href="https://printjs-4de6.kxcdn.com/print.min.css
" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
   
  <div class="container">
      
   <div class="row">
   <div class="col-md-8" >
    <div id="document_id">
       @foreach ($purchases as $purchase)
    <table class="table table-bordered border-primary">
                            <thead>
                                <tr>
        <th>Code</th>
                                    
                                    
                                </tr>
                            </thead>
                            </div>
                             <tbody>
                             
                                    <tr>
                                        
                                        <td>{{ $purchase->code }}</td>
                                        
                                        

                                    </tr>
                             </tbody>
                             <table>
                              <table class="table table-bordered border-primary">
                                 <thead>
                                        <tr>
                                            <th>S/n</th>
                                            <th>Item</th>
                                            <th>Quantinty</th>
                                            <th>Unit Amount</th>
                                            <th>Total Amount</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $total_value = 0;
                                    @endphp

                                    <tbody>
                                       
                                        @foreach ($purchase->items as $purchaseItem)
                                            @php
                                                $total = 0;
                                                $amount = $purchaseItem->unit_price * $purchaseItem->quantity;
                                                $total += $amount;
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $purchaseItem->inventoryItem->name }}</td>
                                                <td>{{ $purchaseItem->quantity }} {{ $purchaseItem->unit->code }}</td>
                                                <td>{{ number_format($purchaseItem->unit_price) }} TZS</td>
                                                <td align="right">{{ number_format($amount) }} TZS</td>
                                            </tr>
                                              @php
                                                 $total_value += $total;
                                              @endphp
                                        @endforeach
                                    </tbody>
                                  
                                 

                                @endforeach
                                 
                                </table>
    
                            </div>
   </div>
   <div class="col-md-4">
    <button type="button" onclick="printJS({
        printable: 'document_id', // ID of the element to print
        type: 'html', // 'html' for printing HTML content
      })">
    Print Report
    </button>
   </div>

  </div>
</body>
</html>