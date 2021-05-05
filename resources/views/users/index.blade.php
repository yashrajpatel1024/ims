
@extends('layouts.app', ['activePage' => 'user', 'titlePage' => __('Users')])

@section('content')
    <!-- User Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Users</h4>
                            <p class="card-category"> Here you can manage users</p>
                        </div>
                        <div class="card-body">
                            @if (session('status'))
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="alert alert-success">
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                            <i class="material-icons">close</i>
                                                        </button>
                                                        <span>{{ session('status') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ route('add') }}" class="btn btn-primary">Add user</a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user['id'] }}</td>
                                                <td>{{ $user['name'] }}</td>
                                                <td>{{ $user['email'] }}</td>
                                                <td class="text-right">
                                                    <div class="dropdown">
                                                        <button class="btn btn-success dropdown-toggle" type="button"
                                                            id="dropdownMenuButton" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href={{"edit/".$user['id']}}><i
                                                                    class="material-icons">edit</i>Edit</a>
                                                            <a class="dropdown-item" onclick="return confirm('Are you sure?')" href="{{"delete/".$user['id']}}"><i
                                                                    class="material-icons">delete</i>Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End User Content -->
@endsection
