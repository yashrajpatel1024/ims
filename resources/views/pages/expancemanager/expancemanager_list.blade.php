@extends('layouts.app', ['activePage' => 'expance', 'titlePage' => __('Expance')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Expance</h4>
                            <p class="card-category"> Here you can show Expance</p>
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
                                    <a href="{{ route('add_expance') }}" class="btn btn-primary">Add Expance
                                    </a>
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
                                                Amount
                                            </th>
                                            <th>
                                                Expance Category
                                            </th>
                                            <th>
                                                Balance Amount
                                            </th>
                                            <th class="text-right">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($expancemanagers))
                                        @foreach ($expancemanagers as $expancemanager)
                                            <tr>
                                                <td>{{ $expancemanager->id }}</td>
                                                <td><?php echo '₹' . number_format($expancemanager->amount,
                                                    2); ?></td>
                                                <td>{{ $expancemanager->catagories }}</td>
                                                <td><?php echo '₹' .
                                                    number_format($expancemanager->current_balance, 2); ?>
                                                </td>
                                                <td class="text-right">
                                                    <div class="dropdown">
                                                        <button class="btn btn-success dropdown-toggle" type="button"
                                                            id="dropdownMenuButton" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item"
                                                                href="{{ 'edit_expance/' . $expancemanager['id'] }}"><i
                                                                    class="material-icons">edit</i>Edit</a>
                                                            <a class="dropdown-item"
                                                                onclick="return confirm('Are you sure?')"
                                                                href="{{ 'delete_expance/' . $expancemanager['id'] }}"><i
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
            </div>
        </div>
    </div>
@endsection
