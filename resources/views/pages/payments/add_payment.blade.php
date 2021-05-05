@extends('layouts.app', ['activePage' => 'payments', 'titlePage' => __('Add Payment')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">{{ __('Add Payment') }}</h4>
                    <p class="card-category">{{ __('Payment information') }}</p>
                </div>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" action="{{ route('add_payments') }}" autocomplete="off"
                                    class="form-horizontal">
                                    @csrf
                                    @method('put')
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h4>Invoice Id</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <select data-style="btn btn-link" name="invoice_id"
                                                    style="width:82.5%;height:30px" id="invoice_select">
                                                    <option value="" disabled selected hidden>Select your invoice
                                                    </option>
                                                    @foreach ($invoices as $invoice)
                                                        <option value="{{ $invoice->id }}"
                                                             data-amount="{{ $invoice->total }}">
                                                            {{ $invoice->id }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h4>Total Amount</h4>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-sm-6">
                                                <input type="text" size="60" name="amount" placeholder="Total Amount" id="amount">
                                            </div>
                                            
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h4>Mode</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <select name="mode" id="mode" style="width:82.3%;height:30px">
                                                    <option value="" disabled selected hidden>Select your Mode
                                                    </option>
                                                    <option value="online">Online</option>
                                                    <option value="cash">Cash</option>
                                                    <option value="cheque">Cheque</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h4>Date</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input name="date" type="date"
                                                    style="width:82.5%;height:30px" placeholder="{{ __('Date') }}"
                                                    required="true" aria-required="true" />
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="card-footer" style="padding-left:45%">
                                        <button class="btn btn-primary">Save</button>
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
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $('#invoice_select').select2({
            placeholder: 'Select Invoice',
            allowClear: true

        });
        $('#mode').select2({
            placeholder: 'Select Mode',
            allowClear: true

        });

        $('#invoice_select').change(function() {
            var amount = $('option:selected', this).attr('data-amount');
            $('#amount').val(amount);
        });

    

    </script>
@endsection
