@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">manage_accounts</i>
                            </div>
                            <p class="card-category"><b>Customers</b></p>
                            <h3 class="card-title">{{ $customer }}</h3>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">receipt</i>
                            </div>
                            <p class="card-category"><b>Invoices</b></p>
                            <h3 class="card-title">{{ $invoice }}</h3>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">settings</i>
                            </div>
                            <p class="card-category"><b>Services</b></p>
                            <h3 class="card-title">{{ $service }}</h3>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">person</i>
                            </div>
                            <p class="card-category"><b>Users</b></p>
                            <h3 class="card-title">{{ $user }}</h3>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>


                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="card card-stats" >
                        <div class="card-header card-header-primary card-header-icon" >
                            <div class="card-icon" style="background-color: #6573c4">
                                <i class="material-icons">credit_card</i>
                            </div>
                            <p class="card-category"><b>Total Payment</b></p>
                            <h3 class="card-title">{{ $amount }}.00</h3>
                        </div>
                        <div class="card-footer">
                            <p class="text-danger">Due Payment : {{ $due_payment }}.00</p>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="card card-stats" >
                        <div class="card-header card-header-success card-header-icon" >
                            <div class="card-icon">
                                <i class="material-icons">account_balance_wallet</i>
                            </div>
                            <p class="card-category"><b>Expance Amount</b></p>
                            <h3 class="card-title">{{ $expance }}.00</h3>
                        </div>
                        <div class="card-footer">
                            <p>Current Amount : {{ $expance_currentBalance }}.00</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header card-header-text card-header-info">
                            <div class="card-text">
                                <h4 class="card-title">Invoice Report</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">  
                                <table class="table">
                                    <thead class=" text-primary">
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
                                            <th style="width: 90px">
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
                                        <td>{{'₹'.number_format($invoicesReport->total,2)}}</td>
                                     </tr>
                                     @endforeach
                                    </tbody>
                                    <tfoot class=" text-primary">
                                        <th colspan="5"> Total </th>
                                        <th>{{$quantity_sum}}</th>
                                        <th>{{'₹'.number_format($sum,2)}}</th>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header card-header-text card-header-warning">
                            <div class="card-text">
                                <h4 class="card-title">Payment Report</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">  
                                <table class="table">
                                    <thead class=" text-primary">
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
                                            <th>
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
                                        <td>{{'₹'.number_format($payment->amount,2)}}</td>
                                        <td>{{'₹'.number_format($payment->paying_amount,2)}}</td>
                                        <td>{{'₹'.number_format($payment->due_amount,2)}}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot class=" text-primary">
                                        <th colspan="5">Total</th>
                                        <th>{{'₹'.number_format($total,2)}}</th>
                                        <th>{{'₹'.number_format($paid_total,2)}}</th>
                                        <th>{{'₹'.number_format($due_total,2)}}</th>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

