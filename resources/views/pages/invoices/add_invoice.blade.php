@extends('layouts.app', ['activePage' => 'invoices', 'titlePage' => __('Add Invoice')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">{{ __('Add Invoice') }}</h4>
                    <p class="card-category">{{ __('Invoice information') }}</p>
                </div>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" action="{{ route('add_invoices') }}" autocomplete="off"
                                    class="form-horizontal">
                                    @csrf
                                    @method('put')
                                    <div class="card-body ">
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
                                                <p>Name *</p>
                                            </div>
                                            <div class="col-sm-5">
                                                <select data-style="btn btn-link" class="form-control" style="width: 50%" name="customer_id"
                                                    id="cust_select">
                                                    <option value="" disabled selected hidden>Select Customer</option>
                                                    @foreach ($customers as $cust)
                                                        <option value="{{ $cust->id }}">
                                                            {{ $cust->first_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('customer_id')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p>Issue Date *</p>
                                            </div>
                                            <div class="col-sm-6">
                                                <p>Due Date *</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input name="issue_date" class="form-control" type="date" style="width: 50%" id="issue_date" />
                                                @error('issue_date')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="due_date" class="form-control" type="date" style="width: 50%" id="due_date" />
                                                @error('due_date')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p>Select Services</p>
                                            </div>
                                            <div class="col-sm-3">
                                                <p>Cost</p>
                                            </div>
                                            <div class="col-sm-3">
                                                <p>Quantity</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <select data-style="btn btn-link" class="form-control" style="width: 100%" id="service_select">
                                                    <option value="" disabled selected hidden>Select Service
                                                    </option>
                                                    @foreach ($services as $service)
                                                        <option value="{{ $service->service_name }}"
                                                            data-rate="{{ $service->cost }}"
                                                            data-id="{{ $service->id }}">
                                                            {{ $service->service_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="cost" placeholder="0.00" style="background-color: white" readonly />
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="number" class="form-control" id="quantity" value="1" min="0"/>
                                            </div>
                                            <div class="col-sm-3" style="margin-top:-6px">
                                                <a type="button" class="btn btn-primary btn-sm" id="add"
                                                    style="color:white">Add
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <input type="hidden" id="subtotal">
                                            <input type="hidden" id="service_id">
                                            <input type="hidden" class="costHidden">
                                            <input type="hidden" class="quantityHidden">
                                            <input type="hidden" class="subtotalHidden">
                                        </div>
                                        <br><br><br>
                                        <div class="table-responsive">
                                            <table class="table" id="myTable">
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
                                                        <th><i class="material-icons">delete</i></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="body">
                                                </tbody>
                                                <tfoot class="text-primary">
                                                    <tr>
                                                        <th>Total</th>
                                                        <th></th>
                                                        <th id="cost_foot">0.00</th>
                                                        <th><input type="hidden" id="costFooterHidden" name="cost"></th>
                                                        <th id="qty_foot">0</th>
                                                        <th><input type="hidden" id="quantityFooterHidden" name="quantity">
                                                        </th>
                                                        <th id="subtotal_foot">0.00</th>
                                                        <th><input type="hidden" id="subtotalFooterHidden" name="subtotal">
                                                        </th>
                                                        <th><i class="material-icons">delete</i></th>
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
                                                                placeholder="0.00" style="background-color: white" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong style="font-weight: bold">Total Quantity :
                                                            </strong><span id="totalQty"
                                                                style="color: #ff0000; font-weight: bold">0</span>
                                                            Units</td>
                                                        <td></td>
                                                        <td class="text-right"><strong style="font-weight: bold">Discount
                                                                :</strong></td>
                                                        <td><input type="text" class="form-control" id="discount" name="discount"
                                                                placeholder="0.00" style="background-color: white" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="text-right"><strong style="font-weight: bold">Tax
                                                                :</strong></td>
                                                        <td><input type="text" class="form-control" id="tax" name="tax" placeholder="0.00"
                                                                style="background-color: white" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="text-right"><strong style="font-weight: bold">Grand
                                                                Total :</strong></td>
                                                        <td><input type="text" class="form-control" id="grandTotal" name="total"
                                                                placeholder="0.00" style="background-color: white" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="text-right"><strong style="font-weight: bold" >Payment Status :</strong></td>
                                                        <td><select name="status" class="form-control">
                                                                <option value="pending">Pending</option>
                                                                <option value="paid">Paid</option>
                                                            </select>
                                                        @error('status')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="card-footer ml-auto mr-auto" style="padding-left: 45%">
                                        <button class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var add = document.getElementById("add");
        add.addEventListener("click", displayDetails);

        var row = 0;

        function displayDetails() {
            var servicename = document.getElementById("service_select").value;
            var serviceId = document.getElementById("service_id").value;
            var cost = document.getElementById("cost").value;
            var costHidden = document.getElementsByClassName("costHidden").value;
            var qty = document.getElementById("quantity").value;
            var qtyHidden = document.getElementsByClassName("quantityHidden").value;
            var subtotal = document.getElementById("subtotal").value;
            var subtotalHidden = document.getElementsByClassName("subtotalHidden").value;

            subtotal = cost * qty;

            if (!servicename) {
                alert("Please fill service name");
                return;
            } else if (!cost) {
                alert("Please fill cost");
                return;
            } else if (!qty) {
                alert("Please fill quantity");
                return;
            }

            var display = document.getElementById("body");

            var newRow = display.insertRow(row);

            var cell1 = newRow.insertCell(00);
            var cell1h = newRow.insertCell(01);
            var cell2 = newRow.insertCell(02);
            var cell2h = newRow.insertCell(03);
            var cell3 = newRow.insertCell(04);
            var cell3h = newRow.insertCell(05);
            var cell4 = newRow.insertCell(06);
            var cell4h = newRow.insertCell(07);
            var cell5 = newRow.insertCell(08);

            cell1.innerHTML = servicename;
            cell1h.innerHTML = "<input type='hidden' name='service_id[]' value=" + serviceId + ">";
            cell2.innerHTML = cost;
            cell2h.innerHTML = "<input type='hidden' class='costHidden'getElementsByClassName name='invoice_cost[]' value=" + cost + ">";
            cell3.innerHTML = qty;
            cell3h.innerHTML = "<input type='hidden' class='quantityHidden' name='invoice_quantity[]' value=" + qty + ">";
            cell4.innerHTML = subtotal;
            cell4h.innerHTML = "<input type='hidden' class='subtotalHidden' name='invoice_subtotal[]' value=" + subtotal + ">";
            cell5.innerHTML =
                "<a type='button' class='btn btn-danger btn-fab btn-fab-mini btn-round' id='delete' style='color:white'><i class='material-icons' >delete</i></a>";

            row++;

            //cost_footer
            var body = document.getElementById("body"),
                cost = 0;

            for (var i = 0; i < body.rows.length; i++) {
                cost = cost + parseInt(body.rows[i].cells[02].innerHTML);
            }

            document.getElementById("cost_foot").innerHTML = cost.toFixed(2);
            document.getElementById("costFooterHidden").value = cost.toFixed(2);

            //quantity_footer
            var body = document.getElementById("body"),
                qty = 0;

            for (var i = 0; i < body.rows.length; i++) {
                qty = qty + parseInt(body.rows[i].cells[04].innerHTML);
            }

            document.getElementById("qty_foot").innerHTML = qty;
            document.getElementById("quantityFooterHidden").value = qty;


            //subtotal_footer
            var body = document.getElementById("body"),
                subtotal = 0;

            for (var i = 0; i < body.rows.length; i++) {
                subtotal = subtotal + parseInt(body.rows[i].cells[06].innerHTML);
            }

            document.getElementById("subtotal_foot").innerHTML = subtotal.toFixed(2);
            document.getElementById("subtotalFooterHidden").value = subtotal.toFixed(2);


            //total
            document.getElementById("total").value = subtotal.toFixed(2);

            //total quantity
            document.getElementById("totalQty").innerHTML = qty;

            //discount
            var discount = -(subtotal * 0.05);
            document.getElementById("discount").value = discount.toFixed(2);

            //tax
            var tax = (subtotal + discount) * 0.18;
            document.getElementById("tax").value = tax.toFixed(2);

            //grandTotal
            var grandTotal = subtotal + discount + tax;
            document.getElementById("grandTotal").value = grandTotal.toFixed(2);
        }

    // service select automatic cost update and Service id show
        $('#service_select').change(function() {

            var rate = $('option:selected', this).attr('data-rate');
            var id = $('option:selected', this).attr('data-id');

            $('#cost').val(rate);
            $('#service_id').val(id);
        });

        $('body').on('click', '#delete', function() {
            $(this).parent().parent().remove();

        });

        // delete row
        $(document).on('click', '#delete', function() {
            $(this).parent().parent().remove();
            costFooter();
            qtyFooter();
            subtotalFooter();
        });

        function costFooter() {
            var costFooter = 0;
            $('.costHidden').each(function() {
                var cost = parseFloat($(this).val()- 0);
                costFooter -= -cost;
            });
            $('#cost_foot').html(costFooter);
            $('#costFooterHidden').val(costFooter.toFixed(2));
        }

        function qtyFooter() {
            var qtyFooter = 0;
            $('.quantityHidden').each(function() {
                var qty = parseFloat($(this).val() - 0);
                qtyFooter -= -qty;
            });
            $('#qty_foot').html(qtyFooter);
            $('#quantityFooterHidden').val(qtyFooter.toFixed(2));
            $('#totalQty').html(qtyFooter);
        }

        function subtotalFooter() {
            var subtotalFooter = 0;
            $('.subtotalHidden').each(function() {
                var subtotal = parseFloat($(this).val() - 0);
                subtotalFooter -= -subtotal;
            });
            $('#subtotal_foot').html(subtotalFooter);
            $('#subtotalFooterHidden').val(subtotalFooter.toFixed(2));


            $('#total').val(subtotalFooter.toFixed(2));

            var discount = -(subtotalFooter * 0.05);
            $('#discount').val(discount.toFixed(2));

            var tax = (subtotalFooter + discount) * 0.18;
            $('#tax').val(tax.toFixed(2));

            var grandTotal = subtotalFooter + discount + tax;
            $('#grandTotal').val(grandTotal.toFixed(2));
        }

    </script>
@endsection
