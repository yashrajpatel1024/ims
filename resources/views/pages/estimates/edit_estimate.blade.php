@extends('layouts.app', ['activePage' => 'estimates', 'titlePage' => __('Edit Estimate')])

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Edit Estimate') }}</h4>
                <p class="card-category">{{ __('Estimate information') }}</p>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="{{ route('edit_estimates') }}" autocomplete="off"
                                class="form-horizontal">
                                @csrf
                                @method('put')
                                <div class="card-body ">
                                    <input type="hidden" name="id" value="{{ $estimates->id }}">
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
                                                <option value="" disabled selected hidden>Select Customer
                                                </option>
                                                @foreach ($customers as $cust)
                                                    <option value="{{ $cust->id }}"
                                                        {{ $cust->id == $estimates->customer_id ? 'selected' : '' }}>
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
                                            <input name="issue_date" class="form-control" type="date" style="width: 50%" id="issue_date" 
                                            value="{{ $estimates->issue_date }}" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input name="due_date" class="form-control" type="date" style="width: 50%" id="due_date" value="{{ $estimates->due_date }}" />
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
                                                @foreach ($estimate_data as $estimateData)
                                                    <tr class="targetfields">
                                                        <td><span>{{ $estimateData->service->service_name }}</span>
                                                        </td>
                                                        <td><input type="hidden" name='service_id[]' class="service_id"
                                                                value="{{ $estimateData->service_id }}">
                                                        </td>
                                                        <td><input type="text" class="estimateCostEdit" class="form-control" name='estimate_cost[]' value="{{ $estimateData->estimate_cost }}">
                                                        </td>
                                                        <td></td>
                                                        <td><input type="text" class="estimateQuantityEdit" name='estimate_quantity[]'
                                                                value="{{ $estimateData->estimate_quantity }}">
                                                        </td>
                                                        <td></td>
                                                        <td><input type="text" class="estimateSubtotalEdit" name='estimate_subtotal[]'
                                                                value="{{ $estimateData->estimate_subtotal }}">
                                                        </td>
                                                        <td></td>
                                                        <td><a type='button' class='btn btn-primary btn-fab btn-fab-mini btn-round' id='update'
                                                                style='color:white' data-id="{{$estimateData->id}}"><i
                                                                class='material-icons'>edit</i></a>
                                                            <a type='button' 
                                                                class='btn btn-danger btn-fab btn-fab-mini btn-round'
                                                                id='delete' style='color:white' data-id="{{$estimateData->id}}"><i
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
                                                    <th id="cost_foot">{{ $estimates->cost }}</th>
                                                    <th><input type="hidden" id="costFooterHidden" name="cost"
                                                            value="{{ $estimates->cost }}"></th>
                                                    <th id="qty_foot">{{ $estimates->quantity }}</th>
                                                    <th><input type="hidden" id="quantityFooterHidden" name="quantity"
                                                            value="{{ $estimates->quantity }}">
                                                    </th>
                                                    <th id="subtotal_foot">{{ $estimates->subtotal }}</th>
                                                    <th><input type="hidden" id="subtotalFooterHidden" name="subtotal"
                                                            value="{{ $estimates->subtotal }}">
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
                                                            placeholder="0.00" value="{{ $estimates->subtotal }}.00" style="background-color: white"
                                                            readonly></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right"><strong style="font-weight: bold">Discount
                                                            :</strong></td>
                                                    <td><input type="text" class="form-control" id="discount" name="discount"
                                                            placeholder="0.00" value="{{ $estimates->discount }}.00" style="background-color: white"
                                                            readonly></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right"><strong style="font-weight: bold">Tax
                                                            :</strong></td>
                                                    <td><input type="text" class="form-control" id="tax" name="tax" placeholder="0.00"
                                                            value="{{ $estimates->tax }}.00" style="background-color: white" readonly>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right"><strong style="font-weight: bold">Grand
                                                            Total :</strong></td>
                                                    <td><input type="text" class="form-control" id="grandTotal" name="total"
                                                            placeholder="0.00" value="{{ $estimates->total }}.00"
                                                            style="background-color: white" readonly>
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
        // var service_select = [];
        // $('#service_select').on('input', function() {
        //     var customer_id = $('#cust_select').val();
        //     var issue_date = $('#issue_date').val();
        //     var due_date = $('#due_date').val();
        //     temp_data = $('#service_select').val();
        //     if (!customer_id) {
        //         $('#service_select').val(temp_data.substring(0, temp_data.length - 1));
        //         alert('Please Select Customer Name...');
        //     } else if (!issue_date) {
        //         $('#service_select').val(temp_data.substring(0, temp_data.length - 1));
        //         alert('Please select Issue Date...');
        //     } else if (!due_date) {
        //         $('#service_select').val(temp_data.substring(0, temp_data.length - 1));
        //         alert('Please select Due Date..');
        //     }
        // });


        //  Add Data

        // var add = document.getElementById("add");
        // add.addEventListener("click", displayDetails);

        // var row;

        // function displayDetails() {
        //     var servicename = document.getElementById("service_select").value;
        //     var serviceId = document.getElementById("service_id").value;
        //     var cost = document.getElementById("cost").value;
        //     var costHidden = document.getElementById("costHidden").value;
        //     var qty = document.getElementById("quantity").value;
        //     var qtyHidden = document.getElementById("quantityHidden").value;
        //     var subtotal = document.getElementById("subtotal").value;
        //     var subtotalHidden = document.getElementById("subtotalHidden").value;

        //     subtotal = cost * qty;

        //     if (!servicename) {
        //         alert("Please fill service name");
        //         return;
        //     } else if (!cost) {
        //         alert("Please fill cost");
        //         return;
        //     } else if (!qty) {
        //         alert("Please fill quantity");
        //         return;
        //     }

        //     var display = document.getElementById("body");

        //     var newRow = display.insertRow(row);

        //     var cell1 = newRow.insertCell(00);
        //     var cell1h = newRow.insertCell(01);
        //     var cell2 = newRow.insertCell(02);
        //     var cell2h = newRow.insertCell(03);
        //     var cell3 = newRow.insertCell(04);
        //     var cell3h = newRow.insertCell(05);
        //     var cell4 = newRow.insertCell(06);
        //     var cell4h = newRow.insertCell(07);
        //     var cell5 = newRow.insertCell(08);

        //     cell1.innerHTML = servicename;
        //     cell1h.innerHTML = "<input type='hidden' name='service_id[]' id='service_id' value=" + serviceId + ">";
        //     cell2.innerHTML = "<input type='text' name='estimate_cost[]'  class='estimateCostEdit' value=" + cost + ">";
        //     cell2h.innerHTML = "<input type='hidden'  value=" + cost + ">";
        //     cell3.innerHTML = "<input type='text' name='estimate_quantity[]' class='estimateQuantityEdit' value=" + qty +
        //         ">";
        //     cell3h.innerHTML = "<input type='hidden'  value=" + qty + ">";
        //     cell4.innerHTML = "<input type='text' name='estimate_subtotal[]' class='estimateSubtotalEdit' value=" +
        //         subtotal + " readonly>";
        //     cell4h.innerHTML = "<input type='hidden' value=" + subtotal + ">";
        //     cell5.innerHTML =
        //         "<a type='button' class='btn btn-primary btn-fab btn-fab-mini btn-round' id='update' style='color:white'><i class='material-icons'>edit</i></a> <a type='button' class='btn btn-danger btn-fab btn-fab-mini btn-round' id='delete' style='color:white'><i class='material-icons' >delete</i></a>";

        //     row--;

        //     //cost_footer
        //     var body = document.getElementById("body"),
        //         cost = 0;
        //     for (var i = 0; i < body.rows.length; i++) {
        //         cost = cost + parseFloat(body.rows[i].cells[02].innerHTML);
        //     }

        //     document.getElementById("cost_foot").innerHTML = cost.toFixed(2);
        //     document.getElementById("costFooterHidden").value = cost.toFixed(2); //costFotterHidden store value


        //     //quantity_footer
        //     var body = document.getElementById("body"),
        //         qty = 0;

        //     for (var i = 0; i < body.rows.length; i++) {
        //         qty = qty + parseFloat(body.rows[i].cells[04].innerHTML);
        //     }

        //     document.getElementById("qty_foot").innerHTML = qty;
        //     document.getElementById("quantityFooterHidden").value = qty; //quantityFotterHidden store value


        //     //subtotal_footer
        //     var body = document.getElementById("body"),
        //         subtotal = 0;

        //     for (var i = 0; i < body.rows.length; i++) {
        //         subtotal = subtotal + parseFloat(body.rows[i].cells[06].innerHTML);
        //     }

        //     document.getElementById("subtotal_foot").innerHTML = subtotal.toFixed(2);
        //     document.getElementById("subtotalFooterHidden").value = subtotal.toFixed(2); //subtotalFotterHidden store value

        //     //total
        //     document.getElementById("total").value = subtotal.toFixed(2);

        //     //discount
        //     var discount = -(subtotal * 0.05);
        //     document.getElementById("discount").value = discount.toFixed(2);

        //     //tax
        //     var tax = (subtotal + discount) * 0.18;
        //     document.getElementById("tax").value = tax.toFixed(2);

        //     //grandTotal
        //     var grandTotal = subtotal + discount + tax;
        //     document.getElementById("grandTotal").value = grandTotal.toFixed(2);
        // }


        // // service select automatic cost update and Service id show

        // $('#service_select').change(function() {

        //     var rate = $('option:selected', this).attr('data-rate');
        //     var id = $('option:selected', this).attr('data-id');

        //     $('#cost').val(rate);
        //     $('#service_id').val(id);
        // });


        // Delet Row 

        $('#body').on('click', '#delete', function() {
            $(this).parent().parent().remove();
            costFooter();
            qtyFooter();
            subtotalFooter();

        });

        function costFooter() {
            var costFooter = 0;
            $('.estimateCostEdit').each(function() {
                var costEdit = parseFloat($(this).val() - 0);
                costFooter -= costEdit;
            });
            $('#cost_foot').html(costFooter);
            $('#costFooterHidden').val(costFooter.toFixed(2));
        }

        function qtyFooter() {
            var qtyFooter = 0;
            $('.estimateQuantityEdit').each(function() {
                var qtyEdit = parseFloat($(this).val() - 0);
                qtyFooter -= qtyEdit;
            });
            $('#qty_foot').html(qtyFooter);
            $('#quantityFooterHidden').val(qtyFooter.toFixed(2));
        }

        function subtotalFooter() {
            var subtotalFooter = 0;
            $('.estimateSubtotalEdit').each(function() {
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

        $("#body").delegate('.estimateCostEdit,.estimateQuantityEdit', 'keyup', function() {
            var tr = $(this).parent().parent();
            var costEdit = tr.find('.estimateCostEdit').val();
            var quantityEdit = tr.find('.estimateQuantityEdit').val();
            var subtotalEdit = (costEdit * quantityEdit);
            tr.find('.estimateSubtotalEdit').val(subtotalEdit);
            costFooter();
            qtyFooter();
            subtotalFooter();
        });

        function costFooter() {
            var costFooter = 0;
            $('.estimateCostEdit').each(function() {
                var costEdit = parseFloat($(this).val() - 0);
                costFooter += costEdit;
            });
            $('#cost_foot').html(costFooter);
            $('#costFooterHidden').val(costFooter.toFixed(2));
        }

        function qtyFooter() {
            var qtyFooter = 0;
            $('.estimateQuantityEdit').each(function() {
                var qtyEdit = parseFloat($(this).val() - 0);
                qtyFooter += qtyEdit;
            });
            $('#qty_foot').html(qtyFooter);
            $('#quantityFooterHidden').val(qtyFooter.toFixed(2));
        }

        function subtotalFooter() {
            var subtotalFooter = 0;
            $('.estimateSubtotalEdit').each(function() {
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

        // $('#add').click(function() {
        //     costFooter();
        //     qtyFooter();
        //     subtotalFooter();
        // });

        // function costFooter() {
        //     var costFooter = 0;
        //     $('.estimateCostEdit').each(function() {
        //         var costEdit = parseFloat($(this).val() - 0);
        //         costFooter += costEdit;
        //     });
        //     $('#cost_foot').html(costFooter);
        //     $('#costFooterHidden').val(costFooter.toFixed(2));

        // }

        // function qtyFooter() {
        //     var qtyFooter = 0;
        //     $('.estimateQuantityEdit').each(function() {
        //         var qtyEdit = parseFloat($(this).val() - 0);
        //         qtyFooter += qtyEdit;
        //     });
        //     $('#qty_foot').html(qtyFooter);
        //     $('#quantityFooterHidden').val(qtyFooter.toFixed(2));
        // }

        // function subtotalFooter() {
        //     var subtotalFooter = 0;
        //     $('.estimateSubtotalEdit').each(function() {
        //         var subtotalEdit = parseFloat($(this).val() - 0);
        //         subtotalFooter += subtotalEdit;
        //     });
        //     $('#subtotal_foot').html(subtotalFooter);
        //     $('#subtotalFooterHidden').val(subtotalFooter.toFixed(2));


        //     $('#total').val(subtotalFooter.toFixed(2));

        //     var discountEdit = -(subtotalFooter * 0.05);
        //     $('#discount').val(discountEdit.toFixed(2));

        //     var taxEdit = (subtotalFooter + discountEdit) * 0.18;
        //     $('#tax').val(taxEdit.toFixed(2));

        //     var grandTotalEdit = subtotalFooter + discountEdit + taxEdit;
        //     $('#grandTotal').val(grandTotalEdit.toFixed(2));
        // }

        $("#body").on('click', '#update', function() {
            var id = $(this).data('id');
            var tr = $(this).parent().parent();
            var service_id = tr.find('.service_id').val();
            var estimate_cost = tr.find('.estimateCostEdit').val();
            var estimate_quantity = tr.find('.estimateQuantityEdit').val();
            var estimate_subtotal = tr.find('.estimateSubtotalEdit').val(); 
            // alert(id + " " + service_id +" " + estimate_cost + " " + estimate_quantity + " " + estimate_subtotal);
            var data = {
                 _token: '{{ csrf_token() }}',
                    id:id,
                    service_id:service_id,
                    estimate_cost: estimate_cost,
                    estimate_quantity: estimate_quantity,
                    estimate_subtotal: estimate_subtotal,
            };
            $.ajax({
                url: '{{route("edit_estimates_data")}}',
                method: 'POST',
                data: data,
                 success:function(data){
                   alert('Updated');
                },error:function(data){ 
                   alert('Error');
                }
            });
        });

        $('#body').on("click", "#delete" , function() {
            var delete_id = $(this).data('id');
            var data = { id:delete_id };
            var url = "{{URL('delete_estimates_data')}}";
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
