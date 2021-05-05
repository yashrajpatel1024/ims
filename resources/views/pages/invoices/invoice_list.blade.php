@extends('layouts.app', ['activePage' => 'invoices', 'titlePage' => __('Invoice')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">Invoice</h4>
                    <p class="card-category"> Here you can show Invoices</p>
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
                            <a href="{{ route('add_invoices') }}" class="btn btn-primary">Add Invoice</a>
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
                                    Bill To
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
                                <th class="text-right">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        @if(count($invoices) > 0)
                        @foreach ($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->id }}</td>
                                <td>{{ $invoice->customer->first_name }}
                                    {{ $invoice->customer->last_name }}</td>
                                <td>@if($invoice->status == 'paid')
                                    <span class="badge badge-success">{{ $invoice->status }}</span>
                                    @elseif($invoice->status == 'pending')
                                    <span class="badge badge-danger">{{ $invoice->status }}</span>
                                    @endif 
                                </td>
                                <td>{{ $invoice->issue_date }}</td>
                                <td>{{ $invoice->due_date }}</td>
                                <td>{{ $invoice->quantity }}</td>
                                <td>{{'₹'.number_format($invoice->total,2)}}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-success dropdown-toggle " href="#" role="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{ 'payment/' . $invoice['id'] }}"><i
                                                    class="material-icons">credit_card</i> Add Payment</a>
                                            <a class="dropdown-item" href="{{ 'edit_invoices/' . $invoice['id'] }}"><i
                                                    class="material-icons">edit</i>Edit</a>
                                            <a class="dropdown-item" href="{{ 'show_invoice/' . $invoice['id'] }}"><i
                                                    class="material-icons">visibility</i> Show Invoice</a>
                                            <a class="dropdown-item" href="{{ 'download_invoice/' . $invoice['id'] }}"><i
                                                    class="material-icons">file_download</i> Download Invoice</a>
                                            <a class="dropdown-item" href="{{ 'send_email/' . $invoice['id'] }}"><i
                                                    class="material-icons">send</i> Send Email Invoice</a>
                                            <a class="dropdown-item" href="{{ 'print_invoice/' . $invoice['id'] }}" ><i
                                                    class="material-icons">print</i>Print Invoice</a>
                                            <a class="dropdown-item" onclick="return confirm('Are you sure?')"
                                                href="{{ 'delete_invoices/' . $invoice['id'] }}"><i
                                                    class="material-icons">delete</i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @else
                        <tr><td colspan="8" style="text-align: center;"><strong>No Data Available in Table</strong></td></tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
