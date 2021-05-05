@extends('layouts.app', ['activePage' => 'payments', 'titlePage' => __('Show Payment')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">{{ __('Show Payment') }}</h4>
                    <p class="card-category">{{ __('Payment information') }}</p>
                </div>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body ">
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-2">
                                            <p style="font-weight: bold">Customer Name</p>
                                        </div>
                                        <div class="col-6">
                                            <p> : {{$payments->invoice->customer->first_name}} {{$payments->invoice->customer->last_name}}</p>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-2">
                                            <p style="font-weight: bold">Invoice Id</p>
                                        </div>
                                        <div class="col-6">
                                            <p> : {{$payments->invoice_id}}<p>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-2">
                                            <p style="font-weight: bold">Total Amount</p>
                                        </div>
                                        <div class="col-6">
                                            <p> : {{$payments->amount}}.00<p>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-2">
                                            <p style="font-weight: bold">Paying Amount</p>
                                        </div>
                                        <div class="col-6">
                                            <p> : {{$payments->paying_amount}}.00<p>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-2">
                                            <p style="font-weight: bold">Due Amount</p>
                                        </div>
                                        <div class="col-6">
                                            <p> : {{$payments->due_amount}}.00<p>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-2">
                                            <p style="font-weight: bold">Payment Mode</p>
                                        </div>
                                        <div class="col-6">
                                            <p> : {{$payments->mode}}<p>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-2">
                                            <p style="font-weight: bold">Paying Date</p>
                                        </div>
                                        <div class="col-6">
                                            <p> : {{$payments->date}}<p>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <br>
                                <div class="card-footer ml-auto mr-auto">
                                    <a class="btn btn-primary" href="/payments_list">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection