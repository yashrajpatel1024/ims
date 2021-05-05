@extends('layouts.app', ['activePage' => 'estimates', 'titlePage' => __('Estimate')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">Estimate</h4>
                    <p class="card-category"> Here you can show Estimate</p>
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
                            <a href="{{ route('add_estimates') }}" class="btn btn-primary">Add Estimate</a>
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
                                    Issue Date
                                </th>
                                <th>
                                    Due Date
                                </th>
                                <th>
                                    Qty
                                </th>
                                <th>
                                    Total
                                </th>
                                <th class="text-right">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        @if(count($estimates)>0)
                        @foreach ($estimates as $estimate)
                            <tr>
                                <td>{{ $estimate->id }}</td>
                                <td>{{ $estimate->customer->first_name }}
                                    {{ $estimate->customer->last_name }}</td>
                                <td>{{ $estimate->issue_date }}</td>
                                <td>{{ $estimate->due_date }}</td>
                                <td>{{ $estimate->quantity }}</td>
                                <td>{{'₹'.number_format($estimate->total,2)}}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-success dropdown-toggle " href="#" role="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{ 'edit_estimates/' . $estimate['id'] }}"><i
                                                    class="material-icons">edit</i>Edit</a>
                                            <a class="dropdown-item" onclick="return confirm('Are you sure?')"
                                                href="{{ 'delete_estimates/' . $estimate['id'] }}"><i
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
