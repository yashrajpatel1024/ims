@extends('layouts.app', ['activePage' => 'customers', 'titlePage' => __('Add Customer')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Add Customer') }}</h4>
                <p class="card-category">{{ __('Customer information') }}</p>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="{{ route('add_customers') }}" autocomplete="off"
                                class="form-horizontal">
                                @csrf
                                @method('put')
                                <div class="card-body ">
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4>First Name *</h4>
                                        </div>
                                        <div class="col-sm-6">
                                            <h4>Last Name *</h4>
                                        </div>

                                    </div>
                                    <div class="row">

                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="first_name" placeholder="First Name">
                                            @error('first_name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                                            @error('last_name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4>Email *</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input  class="form-control" name="email" placeholder="Email">
                                            @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4>Mobile No *</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="number" class="form-control" name="mobile_no" placeholder="Mobile No">
                                            @error('mobile_no')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4>Address *</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="add" placeholder="Address">
                                            @error('add')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4>City *</h4>
                                        </div>
                                        <div class="col-sm-6">
                                            <h4>State *</h4>
                                        </div>

                                    </div>
                                    <div class="row">

                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="city" placeholder="City">
                                            @error('city')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="state" placeholder="State">
                                            @error('state')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4>Pincode *</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="number" class="form-control" name="pincode" placeholder="Pincode">
                                            @error('pincode')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <br>
                                    <div class="card-footer" style="padding-left:45%">
                                        <button class="btn btn-primary">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
