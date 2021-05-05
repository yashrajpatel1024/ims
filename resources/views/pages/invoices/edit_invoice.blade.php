@extends('layouts.app', ['activePage' => 'invoices', 'titlePage' => __('Edit Invoice')])

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Edit Invoice') }}</h4>
                <p class="card-category">{{ __('Invoice information') }}</p>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="{{ route('edit_invoices') }}" autocomplete="off"
                                class="form-horizontal">
                                @csrf
                                @method('put')
                                <div class="card-body ">
                                    <input type="hidden" name="id" value="{{ $invoices->id }}">
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4><b>From</b></h4>
                                        </div>
                                        <div class="col-sm-6">
                                            <h4><b>Bill To</b></h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-1" style="padding-top: 10px">
                                            <p>Name</p>
                                            <p>Email</p>
                                            <p>Address</p>
                                            <p>Phone</p>
                                        </div>
                                        <div class="col-sm-5" style="padding-top: 10px">
                                            <p> : Business Name </p>
                                            <p> : email@example.com </p>
                                            <p> : Street </p>
                                            <p> : 9587463210 </p>
                                        </div>
                                        <div class="col-sm-1">
                                            <p>Name</p>
                                        </div>
                                        <div class="col-sm-5">
                                            <select data-style="btn btn-link" class="form-control" style="width: 50%" name="customer_id"
                                                id="cust_select" required=" true">
                                                <option value="" disabled selected hidden>
                                                </option>
                                                @foreach ($customers as $cust)
                                                    <option value="{{ $cust->id }}"
                                                        {{ $cust->id == $invoices->customer_id ? 'selected' : '' }}>
                                                        {{ $cust->first_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p>Issue Date</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <p>Due Date</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input name="issue_date" class="form-control" type="date" required=" true" aria-required="true"
                                                style="width: 50%" id="issue_date"
                                                value="{{ $invoices->issue_date }}" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input name="due_date" class="form-control" type="date" required=" true" aria-required="true"
                                                style="width: 50%" id="due_date" value="{{ $invoices->due_date }}" />
                                        </div>
                                    </div>
                                    <br>
                                    
                                    <div class="row">
                                        <input type="hidden" id="subtotal">
                                        <input type="hidden" id="service_id">
                                        <input type="hidden" id="costHidden">
                                        <input type="hidden" id="quantityHidden">
                                        <input type="hidden" id="subtotalHidden">
                                    </div>
                                    <br><br><br>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class=" text-primary">
                                                <tr>
                                                    <th>Service</th>
                                                    <th></th>
                                                    <th>Cost</th>
                                                    <th></th>
                                                    <th>Quantity</th>
                                                    <th></th>
                                                    <th>Subtotal</th>
                                                    <th></th>   
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="body">
                                                @foreach ($invoice_data as $invoiceData)
                                                    <tr class="targetfields">
                                                        <td><span>{{ $invoiceData->service->service_name }}</span>
                                                        </td>
                                                        <td><input type="hidden" name='service_id[]' class="service_id"
                                                                value="{{ $invoiceData->service_id }}">
                                                        </td>
                                                        <td><input type="text" class="invoiceCostEdit" name='invoice_cost[]' value="{{ $invoiceData->invoice_cost }}">
                                                        </td>
                                                        <td></td>
                                                        <td><input type="text" class="invoiceQuantityEdit" name='invoice_quantity[]' value="{{ $invoiceData->invoice_quantity }}">
                                                        </td>
                                                        <td></td>
                                                        <td><input type="text" class="invoiceSubtotalEdit" name='invoice_subtotal[]' value="{{ $invoiceData->invoice_subtotal }}" readonly>
                                                        </td>
                                                        <td></td>
                                                        <td><a type='button' class='btn btn-primary btn-fab btn-fab-mini btn-round' id='update'
                                                                style='color:white' data-id="{{$invoiceData->id}}"><i
                                                                class='material-icons'>edit</i></a>
                                                            <a type='button' 
                                                                class='btn btn-danger btn-fab btn-fab-mini btn-round'
                                                                id='delete' style='color:white' data-id="{{$invoiceData->id}}"><i
                                                                class='material-icons' >delete</i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                             </tbody>
                                            <tfoot class="text-primary">
                                                <tr>
                                                    <th>Total</th>
                                                    <th></th>
                                                    <th id="cost_foot">{{ $invoices->cost }}</th>
                                                    <th><input type="hidden" id="costFooterHidden" name="cost"
                                                            value="{{ $invoices->cost }}"></th>
                                                    <th id="qty_foot">{{ $invoices->quantity }}</th>
                                                    <th><input type="hidden" id="quantityFooterHidden" name="quantity"
                                                            value="{{ $invoices->quantity }}">
                                                    </th>
                                                    <th id="subtotal_foot">{{ $invoices->subtotal }}</th>
                                                    <th><input type="hidden" id="subtotalFooterHidden" name="subtotal"
                                                            value="{{ $invoices->subtotal }}">
                                                    </th>
                                                    <th>
                                                        Actions
                                                    </th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <br><br><br>
                                    <div class="table-responsive">
                                        <table class="table" id="myTable">
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right"><strong style="font-weight: bold">Total
                                                            :</strong></td>
                                                    <td style="width: 20%"><input type="text" class="form-control" id="total"
                                                            placeholder="0.00" value="{{ $invoices->subtotal }}.00"
                                                            style="background-color: white" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right"><strong style="font-weight: bold">Discount
                                                            :</strong></td>
                                                    <td><input type="text" class="form-control" id="discount" name="discount"
                                                            placeholder="0.00" value="{{ $invoices->discount }}.00"
                                                            style="background-color: white" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right"><strong style="font-weight: bold">Tax
                                                            :</strong></td>
                                                    <td><input type="text" class="form-control" id="tax" name="tax" placeholder="0.00"
                                                            value="{{ $invoices->tax }}.00" style="background-color: white" readonly>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right"><strong style="font-weight: bold">Grand
                                                            Total :</strong></td>
                                                    <td><input type="text" class="form-control" id="grandTotal" name="total"
                                                            placeholder="0.00" value="{{ $invoices->total }}.00"
                                                            style="background-color: white" readonly>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right"><strong style="font-weight: bold">Status :</strong></td>
                                                    <td><select name="status" class="form-control" value="{{ $invoices->status }}">
                                                            <option value="pending" @if(old('status', $invoices->status)
                                                                === 'pending') selected @endif>pending</option>
                                                            <option value="paid" @if(old('status', $invoices->
                                                                status) === 'paid') selected @endif>paid</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer ml-auto mr-auto" style="padding-left: 45%">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>          
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        // Delet Row 

        $('#body').on('click', '#delete', function() {
            $(this).parent().parent().remove();
            costFooter();
            qtyFooter();
            subtotalFooter();

        });

        function costFooter() {
            var costFooter = 0;
            $('.invoiceCostEdit').each(function() {
                var costEdit = parseFloat($(this).val() - 0);
                costFooter -= costEdit;
            });
            $('#cost_foot').html(costFooter);
            $('#costFooterHidden').val(costFooter.toFixed(2));
        }

        function qtyFooter() {
            var qtyFooter = 0;
            $('.invoiceQuantityEdit').each(function() {
                var qtyEdit = parseFloat($(this).val() - 0);
                qtyFooter -= qtyEdit;
            });
            $('#qty_foot').html(qtyFooter);
            $('#quantityFooterHidden').val(qtyFooter.toFixed(2));
        }

        function subtotalFooter() {
            var subtotalFooter = 0;
            $('.invoiceSubtotalEdit').each(function() {
                var subtotalEdit = parseFloat($(this).val() - 0);
                subtotalFooter -= subtotalEdit;
            });
            $('#subtotal_foot').html(subtotalFooter);
            $('#subtotalFooterHidden').val(subtotalFooter.toFixed(2));


            $('#total').val(subtotalFooter.toFixed(2));

            var discountEdit = -(subtotalFooter * 0.05);
            $('#discount').val(discountEdit.toFixed(2));

            var taxEdit = (subtotalFooter + discountEdit) * 0.18;
            $('#tax').val(taxEdit.toFixed(2));

            var grandTotalEdit = subtotalFooter + discountEdit + taxEdit;
            $('#grandTotal').val(grandTotalEdit.toFixed(2));
        }

        // Edit Data

        $("#body").delegate('.invoiceCostEdit,.invoiceQuantityEdit', 'keyup', function() {
            var tr = $(this).parent().parent();
            var costEdit = tr.find('.invoiceCostEdit').val();
            var quantityEdit = tr.find('.invoiceQuantityEdit').val();
            var subtotalEdit = costEdit * quantityEdit;
            tr.find('.invoiceSubtotalEdit').val(subtotalEdit);
            console.log(subtotalEdit);
            costFooter();
            qtyFooter();
            subtotalFooter();
        });

        function costFooter() {
            var costFooter = 0;
            $('.invoiceCostEdit').each(function() {
                var costEdit = parseFloat($(this).val() - 0);
                costFooter += costEdit;
            });
            $('#cost_foot').html(costFooter);
            $('#costFooterHidden').val(costFooter.toFixed(2));
        }

        function qtyFooter() {
            var qtyFooter = 0;
            $('.invoiceQuantityEdit').each(function() {
                var qtyEdit = parseFloat($(this).val() - 0);
                qtyFooter += qtyEdit;
            });
            $('#qty_foot').html(qtyFooter);
            $('#quantityFooterHidden').val(qtyFooter.toFixed(2));
        }

        function subtotalFooter() {
            var subtotalFooter = 0;
            $('.invoiceSubtotalEdit').each(function() {
                var subtotalEdit = parseFloat($(this).val() - 0);
                subtotalFooter += subtotalEdit;
            });
            $('#subtotal_foot').html(subtotalFooter);
            $('#subtotalFooterHidden').val(subtotalFooter.toFixed(2));


            $('#total').val(subtotalFooter.toFixed(2));

            var discountEdit = -(subtotalFooter * 0.05);
            $('#discount').val(discountEdit.toFixed(2));

            var taxEdit = (subtotalFooter + discountEdit) * 0.18;
            $('#tax').val(taxEdit.toFixed(2));

            var grandTotalEdit = subtotalFooter + discountEdit + taxEdit;
            $('#grandTotal').val(grandTotalEdit.toFixed(2));
        }

        

        $("#body").on('click', '#update', function() {
            var id = $(this).data('id');
            var tr = $(this).parent().parent();
            var service_id = tr.find('.service_id').val();
            var invoice_cost = tr.find('.invoiceCostEdit').val();
            var invoice_quantity = tr.find('.invoiceQuantityEdit').val();
            var invoice_subtotal = tr.find('.invoiceSubtotalEdit').val();
            // alert(id + " " + service_id +" " + invoice_cost + " " + invoice_quantity + " " + invoice_subtotal);
            var data = {
                 _token: '{{ csrf_token() }}',
                    id:id,
                    service_id:service_id,
                    invoice_cost: invoice_cost,
                    invoice_quantity: invoice_quantity,
                    invoice_subtotal: invoice_subtotal,
            };
            // console.log(data);
            $.ajax({
                url: '{{route("edit_invoices_data")}}',
                method: 'POST',
                data: data,
                 success:function(data){
                   alert('Updated');
                },error:function(data){ 
                   // alert('Error');
                   // console.log(data);
                    alert('Request Status: ' + data.status + ' Status Text: ' + data.statusText + ' ' + data.responseText);
                
                }
            });
        });

        $('#body').on("click", "#delete" , function() {
            var delete_id = $(this).data('id');
            var data = { id:delete_id };
            var url = "{{URL('delete_invoices_data')}}";
            var dltUrl = url+"/"+delete_id;
            var confirmalert = confirm("Are you sure?");
            if (confirmalert == true) {
            $.ajax({
                url: dltUrl,
                type: 'get',
                 data: data,
                    success: function(data){
                    $(this).closest( "tr" ).remove();
                    alert("Deleted");
                    },error:function(data){ 
                   alert("Error!");
                }
            });
            }
        });
    </script>
@endsection 
