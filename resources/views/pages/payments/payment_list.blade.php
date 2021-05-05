@extends('layouts.app', ['activePage' => 'payments', 'titlePage' => __('Payment')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">Payment</h4>
                    <p class="card-category"> Here you can show Payments</p>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="material-icons">close</i>
                                    </button>
                                    <span>{{ session('status') }}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-12 text-right">
                            <!-- <a href="{{ route('add_payments') }}" class="btn btn-primary">Add Payment</a> -->
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead class=" text-primary">
                            <tr>
                                <th>
                                    Id
                                </th>
                                <th>
                                    Invoice_id
                                </th>
                                <th>
                                    Customer Name
                                </th>
                                <th>
                                    Amount
                                </th>
                                <th>
                                    Mode
                                </th>
                                <th>
                                    Date
                                </th>
                                <th>
                                    Paid
                                </th>
                                <th>
                                    Due
                                </th>
                                <th class="text-right">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(count($payments) > 0)
                        @foreach ($payments as $payment)
                            <tr>
                                <td>{{ $payment->id }}</td>
                                <td>{{ $payment->invoice_id }}</td>
                                <td>{{$payment->invoice->customer->first_name}} {{$payment->invoice->customer->last_name}}</td>
                                <td>{{'₹'.number_format($payment->amount,2)}}</td>
                                <td>{{ $payment->mode }}</td>
                                <td>{{ $payment->date }}</td>
                                <td>{{'₹'.number_format($payment->paying_amount,2)}}</td>
                                <td>{{'₹'.number_format($payment->due_amount,2)}}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-success dropdown-toggle " href="#" role="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{ 'edit_payments/' . $payment['id'] }}"><i
                                                    class="material-icons">edit</i>Edit</a>
                                            <a class="dropdown-item" href="{{ 'show_payment/' . $payment['id'] }}"><i
                                                    class="material-icons">visibility</i>Show Payment</a>
                                            <a class="dropdown-item" onclick="return confirm('Are you sure?')" href="{{ 'delete_payments/' . $payment['id'] }}"><i
                                                    class="material-icons">delete</i>Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @else
                        <tr><td colspan="8" style="text-align: center;"><strong>No Data Available in Table</strong></td></tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
