@extends('layouts.app', ['activePage' => 'invoices', 'titlePage' => __('Show Invoice')])

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Show Invoice') }}</h4>
                <p class="card-category">{{ __('Invoice information') }}</p>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body ">
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
                                <br>
                                <div class="row">
                                    <div class="col-sm-1">
                                        <p style="font-weight: bold">Name</p>
                                        <p style="font-weight: bold">Email</p>
                                        <p style="font-weight: bold">Address</p>
                                        <p style="font-weight: bold">Phone</p>
                                    </div>
                                    <div class="col-sm-5">
                                        <p> : Business Name </p>
                                        <p> : email@example.com </p>
                                        <p> : Street </p>
                                        <p> : 9587463210 </p>
                                    </div>
                                    <div class="col-sm-1">
                                        <p style="font-weight: bold">Name</p>
                                        <p style="font-weight: bold">Email</p>
                                        <p style="font-weight: bold">Address</p>
                                        <p style="font-weight: bold">Mobile No.</p>
                                    </div>
                                    <div class="col-sm-5">
                                        <p> : {{$invoices->customer->first_name}} {{$invoices->customer->last_name}} </p>
                                        <p> : {{$invoices->customer->email}} </p>
                                        <p> : {{$invoices->customer->add}} </p>
                                        <p> : {{$invoices->customer->mobile_no}} </p>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-sm-1">
                                        <p style="font-weight: bold">Issue Date</p>
                                    </div>
                                    <div class="col-sm-5">
                                        <p> : {{$invoices->issue_date}}</p>
                                    </div>
                                    <div class="col-sm-1">
                                        <p style="font-weight: bold">Due Date</p>
                                    </div>
                                    <div class="col-sm-5">
                                        <p> : {{$invoices->due_date}}</p>
                                    </div>
                                </div>
                                <br>
                                <br>
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
                                            </tr>
                                        </thead>
                                        <tbody id="body">
                                            @foreach ($invoice_data as $invoiceData)
                                                <tr class="targetfields">
                                                    <td><span>{{ $invoiceData->service->service_name }}</span></td>
                                                    <td></td>
                                                    <td><span>{{ $invoiceData->invoice_cost }}</span></td>
                                                    <td></td>
                                                    <td><span>{{ $invoiceData->invoice_quantity }}</span></td>
                                                    <td></td>
                                                    <td><span>{{ $invoiceData->invoice_subtotal }}</span></td>
                                                    <td></td>
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
                                                <td style="width: 20%">{{$invoices->subtotal}}.00</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td class="text-right"><strong style="font-weight: bold">Discount
                                                        :</strong></td>
                                                <td>{{ $invoices->discount }}.00</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td class="text-right"><strong style="font-weight: bold">Tax
                                                        :</strong></td>
                                                <td>{{ $invoices->tax }}.00</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td class="text-right"><strong style="font-weight: bold">Grand
                                                        Total :</strong></td>
                                                <td>{{ $invoices->total }}.00
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td class="text-right"><strong style="font-weight: bold">Status :</strong></td>
                                                <td>{{ $invoices->status }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-2">
                                    <a href="{{ '/download_invoice/' . $invoices['id'] }}" class="btn btn-primary">Download</a>
                                </div>
                                <div class="col-sm-6">
                                    <a class="btn btn-success" href="{{ '/send_email/' . $invoices['id'] }}">Email</a>
                                </div>
                            </div>
                        </div>
                    </div>          
                </div>
            </div>
        </div>
    </div>
@endsection