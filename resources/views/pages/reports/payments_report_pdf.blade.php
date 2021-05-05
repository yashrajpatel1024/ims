<head>
    <style>
        .table{
            width: 100%;
        }
        .table td,.table th{
            padding: 3px;
        }
        .table th{
            text-align: left;
        }
    </style>
</head>
<table class="table">
    <thead>
        <tr>
            <th>
                No.
            </th>
            <th>
                Invoice Id
            </th>
            <th>
                Customer
            </th>
            <th style="width: 15%">
                Date
            </th>
            <th>
                Mode
            </th>
            <th>
                Total
            </th>
            <th>
                Paid
            </th>
            <th>
                Due
            </th>
        </tr>
    </thead>
    <tbody>
     @foreach($payments as $key=>$payment)
     <tr>
         <td>{{$key+1}}</td>
         <td>{{$payment->invoice_id}}</td>
         <td>{{$payment->invoice->customer->first_name}} {{$payment->invoice->customer->last_name}}</td>
         <td>{{$payment->date}}</td>
         <td>{{$payment->mode}}</td>
         <td>{{number_format($payment->amount,2)}}</td>
         <td>{{number_format($payment->paying_amount,2)}}</td>
         <td>{{number_format($payment->due_amount,2)}}</td>
     </tr>
     @endforeach
    </tbody>
    <tfoot class=" text-primary">
        <th colspan="5">Total</th>
        <th>{{number_format($total,2)}}</th>
        <th>{{number_format($paid_total,2)}}</th>
        <th>{{number_format($due_total,2)}}</th>
    </tfoot>
</table>