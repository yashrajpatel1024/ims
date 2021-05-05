@extends('layouts.app', ['activePage' => 'customers_report', 'titlePage' => __('Customer Report')])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
        	<div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Customer Report</h4>
                        <p class="card-category"> Here you can show Report</p>
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
                                {{Form::select('id', [null => 'Select Customers']+$customers, Input::get('id')??null, ['class' => 'form-control'])}}
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
                        <a type="submit" class="btn btn-success left" href="{{route('download_customer_report', ['id' => Input::get('id'), 'start_date' => Input::get('start_date'),'end_date' => Input::get('end_date')])}}">Excel</a>
                        <a type="submit" class="btn btn-danger left" href="{{route('download_customer_report_pdf', ['id' => Input::get('id'), 'start_date' => Input::get('start_date'),'end_date' => Input::get('end_date')])}}">pdf</a>
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
                                            Email
                                        </th>
                                        <th>
                                            Mobile No
                                        </th>
                                        <th>
                                            Adress
                                        </th>
                                        <th>
                                            Pincode
                                        </th>
                                        <th>
                                            City
                                        </th>
                                        <th>
                                            State
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(count($customersReports) > 0 )
                                  @foreach($customersReports as $key=>$customersReport)
                                 <tr>
                                     <td>{{$key+1}}</td>
                                     <td>{{$customersReport->first_name}} {{$customersReport->last_name}}</td>
                                     <td>{{$customersReport->email}}</td>
                                     <td>{{$customersReport->mobile_no}}</td>
                                     <td>{{$customersReport->add}}</td>
                                     <td>{{$customersReport->pincode}}</td>
                                     <td>{{$customersReport->city}}</td>
                                     <td>{{$customersReport->state}}</td>
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
        </div>
    </div>
</div>
@endsection