@extends('layouts.app', ['activePage' => 'payments_report', 'titlePage' => __('Payment Report')])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
        	<div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Payment Report</h4>
                        <p class="card-category">Here you can show Report</p>
                    </div>
                    <div class="card-body">
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-3">
                                <p>Customer Name</p>
                            </div>
                            <div class="col-3">
                                <p>Start Date</p>
                            </div>
                            <div class="col-3">
                                <p>End Date</p>
                            </div>
                        </div>
                        <form action="{{url()->current()}}" method="GET" autocomplete="off">
                        <div class="row">
                            <div class="col-3 form-group">  
                                {{Form::select('customer_id', [null => 'Select Customers']+$customers, Input::get('customer_id')??null, ['class' => 'form-control','required'])}}
                            </div>
                            <div class="col-3">
                                <input name="start_date" type="date" value="{{Input::get('start_date')}}" required="true" aria-required="true" class="form-control" style="margin-top:12px"/>
                            </div>
                            <div class="col-3">
                                <input name="end_date" value="{{Input::get('end_date')}}" type="date" required="true" aria-required="true" class="form-control" 
                                style="margin-top:12px"/>
                            </div>
                            <div class="col-3">
                                <button type="submit" class="btn btn-primary" style="margin-top:-6px">Submit</button>
                            </div>
                        </div>
                        </form>
                        <br>
                        <br>
                        <div class="col-12 text-right">
                        <a type="submit" class="btn btn-success left" href="{{route('download_payment_report', ['customer_id' => Input::get('customer_id'), 'start_date' => Input::get('start_date'),'end_date' => Input::get('end_date')])}}">Excel</a>
                        <a type="submit" class="btn btn-danger left" href="{{route('download_payment_report_pdf', ['customer_id' => Input::get('customer_id'), 'start_date' => Input::get('start_date'),'end_date' => Input::get('end_date')])}}">pdf</a>
                        </div>
                        <br>
                        <br>
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
                                @if(isset($payments) && !empty($payments))
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
                                @else
                                <tr><td colspan="8" style="text-align: center;"><strong>No Data Available in Table</strong></td></tr>
                                @endif
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
