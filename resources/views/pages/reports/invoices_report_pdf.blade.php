<head>
    <style>
        #inv{
            width: 100%;
        }
        #inv td,#inv th{
            padding: 3px;
        }
        #inv th{
            text-align: left;
        }
        .badge {
            display: inline-block;
            padding: 0.25em 0.4em;
            font-size: 75%;
            font-weight: 500;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
        }
        .badge-danger {
            color: #ffffff;
            background-color: #f44336;
        }
        .badge-success {
            color: #ffffff;
            background-color: #4caf50;
        }
    </style>
</head>
<body>
    <table id="inv">
        <thead>
            <tr>
                <th>
                    No.
                </th>
                <th>
                    Name
                </th>
                <th>
                    Status
                </th>
                <th>
                    Issue Date
                </th>
                <th>
                    Due Date
                </th>
                
                <th>
                    Quantity
                </th>
                <th>
                    Total
                </th>
            </tr>
        </thead>
        <tbody>
          @foreach($invoicesReports as $key=>$invoicesReport)
         <tr>
            <td>{{$key+1}}</td>
            <td>{{$invoicesReport->customer->first_name}} {{$invoicesReport->customer->last_name}}</td>
            <td>@if($invoicesReport->status == 'paid')
                <span class="badge badge-success">{{$invoicesReport->status}}</span>
                @elseif($invoicesReport->status == 'pending')
                <span class="badge badge-danger">{{$invoicesReport->status}}</span>
                @endif
            </td>
            <td>{{$invoicesReport->issue_date}}</td>
            <td>{{$invoicesReport->due_date}}</td>
            <td>{{$invoicesReport->quantity}}</td>
            <td>{{number_format($invoicesReport->total,2)}}</td>
         </tr>
         @endforeach
        </tbody>
        <tfoot>
            <th>Total</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>{{$quantity_sum}}</th>
            <th>{{number_format($sum,2)}}</th>
            
        </tfoot>
    </table>