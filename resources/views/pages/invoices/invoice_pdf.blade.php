<head>
    <title>Test Mail</title>
</head>
<body style="border-style: solid;padding: 10px;">
    <center><h2>Invoice</h2></center>
    <hr>
        <br>
            <p style="font-weight: bold">Invoice Id : {{$invoices->id}}</p>
        <table style="width: 100%" >
            <tbody>
                <tr>
                    <td style="width: 15%"><h4><b style="font-size: 20px;">From</b></h4></td>
                    <td style="width: 35%"></td>
                    <td style="width: 15%"><h4><b style="font-size: 20px;">Bill To</b></h4></td>
                    <td style="width: 35%"></td>
                </tr>
                <tr>
                    <td>
                        <p style="font-weight: bold">Name :</p>
                        <p style="font-weight: bold">Email :</p>
                        <p style="font-weight: bold">Address :</p>
                        <p style="font-weight: bold">Phone :</p>
                    </td>
                    <td><p>Business Name </p>
                        <p>email@example.com </p>
                        <p>Street </p>
                        <p>9587463210 </p>
                    </td>
                    <td>
                        <p style="font-weight: bold">Name :</p>
                        <p style="font-weight: bold">Email :</p>
                        <p style="font-weight: bold">Address :</p>
                        <p style="font-weight: bold">Mobile No. :</p>
                    </td>
                    <td>
                        <p>{{$invoices->customer->first_name}} {{$invoices->customer->last_name}} </p>
                        <p>{{$invoices->customer->email}} </p>
                        <p>{{$invoices->customer->add}} </p>
                        <p>{{$invoices->customer->mobile_no}} </p>
                    </td>
                </tr>
                <tr><td colspan="4">&nbsp;</td></tr>
                <tr>
                    <td>
                        <p style="font-weight: bold">Issue Date</p>
                    </td>
                    <td>
                        <p> : {{$invoices->issue_date}}</p>
                    </td>
                    <td>
                        <p style="font-weight: bold">Due Date</p>
                    </td>
                    <td>
                        <p> : {{$invoices->due_date}}</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <br>
        <table style="width: 100%;border-collapse: collapse;" >
            <thead >
                <tr style="border-bottom:1pt solid gray;">
                    <th style="text-align: left;">Service</th>
                    <th style="text-align: left;">Cost</th>
                    <th style="text-align: left;">Quantity</th>
                    <th style="text-align: left;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice_data as $invoiceData)
                    <tr style="border-bottom:1pt solid gray;">
                        <td><span>{{ $invoiceData->service->service_name }}</span></td>
                        <td><span>{{ $invoiceData->invoice_cost }}</span></td>
                        <td><span>{{ $invoiceData->invoice_quantity }}</span></td>
                        <td><span>{{ $invoiceData->invoice_subtotal }}</span></td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot style="text-align: left;">
                <tr style="border-bottom:1pt solid gray;">
                    <th style="text-align: left;">Total</th>
                    <th style="text-align: left;">{{ $invoices->cost }}</th>
                    <th style="text-align: left;">{{ $invoices->quantity }}</th>
                    <th style="text-align: left;">{{ $invoices->subtotal }}</th>
                </tr>
            </tfoot>
        </table>
        <br><br><br>
            <table style="width: 100%;border-collapse: collapse;" >
                <tbody>
                    <tr style="border-bottom:1pt solid gray;">
                        <td style="width: 40%"></td>
                        <td style="width: 30%"></td>
                        <td><strong style="font-weight: bold">Total:</strong></td>
                        <td> : {{$invoices->subtotal}}.00</td>
                    </tr>
                    <tr style="border-bottom:1pt solid gray;">
                        <td></td>
                        <td></td>
                        <td><strong style="font-weight: bold">Discount </strong></td>
                        <td> : {{ $invoices->discount }}.00</td>
                    </tr>
                    <tr style="border-bottom:1pt solid gray;">
                        <td></td>
                        <td></td>
                        <td><strong style="font-weight: bold">Tax</strong></td>
                        <td> : {{ $invoices->tax }}.00</td>
                    </tr>
                    <tr style="border-bottom:1pt solid gray;">
                        <td></td>
                        <td></td>
                        <td><strong style="font-weight: bold">Grand Total</strong></td>
                        <td> : {{ $invoices->total }}.00
                        </td>
                    </tr>
                    <tr style="border-bottom:1pt solid gray;">
                        <td></td>
                        <td></td>
                        <td><strong style="font-weight: bold">Status</strong></td>
                        <td> : {{ $invoices->status }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>