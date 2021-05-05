@extends('layouts.app', ['activePage' => 'invoices_report', 'titlePage' => __('Invoice Report')])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
        	<div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Invoice Report</h4>
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
                                {{Form::select('customer_id', [null => 'Select Customers']+$customers, Input::get('customer_id')??null, ['class' => 'form-control'])}}
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
                        <br>
                        <div class="col-12 text-right">
                        <a type="submit" class="btn btn-success left" href="{{route('download_invoice_report', ['customer_id' => Input::get('customer_id'), 'start_date' => Input::get('start_date'),'end_date' => Input::get('end_date')])}}">Excel</a>
                        <a type="submit" class="btn btn-danger left" href="{{route('download_invoice_report_pdf', ['customer_id' => Input::get('customer_id'), 'start_date' => Input::get('start_date'),'end_date' => Input::get('end_date')])}}">PDF</a>
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
                                @if(count($invoicesReports) > 0)
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
                                 @else
                                 <tr><td colspan="8" style="text-align: center;"><strong>No Data Available in Table</strong></td></tr>
                                 @endif
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
        </div>
    </div>
</div>
@endsection