@extends('layouts.app', ['activePage' => 'todo', 'titlePage' => __('Todo')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Todo</h4>
                            <p class="card-category"> Here you can show Todo</p>
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
                                    <a href="{{ route('add_todo') }}" class="btn btn-primary">Add Todo</a>
                                    <!-- <button type="button" class="btn btn-danger" id="deleteAllSelected">Delete Selected</button> -->
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <tr>
                                           <!--  <th style="width: 4%"><input type="checkbox" id="chkChecAll"></th> -->
                                            <th>
                                                Id
                                            </th>
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                Description
                                            </th>
                                            <th class="text-right">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    @if(count($todos)>0)
                                    @foreach ($todos as $todo)
                                        <tr id="tid{{ $todo->id}}">
                                            <!-- <td><input type="checkbox" name="ids" class="checBoxclass" value="{{ $todo->id }}"></td> -->
                                            <td>{{ $todo->id }}</td>
                                            <td>{{ $todo->name }}</td>
                                            <td>{{ $todo->description }}</td>
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <button class="btn btn-success dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="{{ 'edit_todo/' . $todo['id'] }}"><i
                                                                class="material-icons">edit</i>Edit</a>
                                                        <a class="dropdown-item" onclick="return confirm('Are you sure?')" href="{{ 'delete_todo/' . $todo['id'] }}"><i
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
            </div>
        </div>
    </div>
@endsection