@extends('layouts.app', ['activePage' => 'customers', 'titlePage' => __('Customer')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">Customer</h4>
                    <p class="card-category"> Here you can show Customers</p>
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
                            <a href="{{ route('add_customers') }}" class="btn btn-primary">Add Customer</a>
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
                                    Name
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Mobile No
                                </th>
                                <th>
                                    Add
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
                                <th class="text-right">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        @if(count($customers)>0)
                        @foreach ($customers as $cust)
                            <tr>
                                <td>{{ $cust->id }}</td>
                                <td>{{ $cust->first_name }}
                                    {{ $cust->last_name }}</td>
                                <td>{{ $cust->email }}</td>
                                <td>{{ $cust->mobile_no }}</td>
                                <td>{{ $cust->add }}</td>
                                <td>{{ $cust->pincode }}</td>
                                <td>{{ $cust->city }}</td>
                                <td>{{ $cust->state }}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-success dropdown-toggle" href="#" role="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{ 'edit_customers/' . $cust['id'] }}"><i
                                                    class="material-icons">edit</i>Edit</a>
                                            <a class="dropdown-item" onclick="return confirm('Are you sure?')"
                                                href="{{ 'delete_customers/' . $cust['id'] }}"><i
                                                    class="material-icons">delete</i>Delete</a>
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
