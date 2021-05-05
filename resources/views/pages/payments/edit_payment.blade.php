@extends('layouts.app', ['activePage' => 'payments', 'titlePage' => __('Edit Payment')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">{{ __('Edit Payment') }}</h4>
                    <p class="card-category">{{ __('Payment information') }}</p>
                </div>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" action="{{ route('edit_payments') }}" autocomplete="off"
                                    class="form-horizontal">
                                    @csrf
                                    @method('put')
                                    <div class="card-body ">
                                        @if (session('status'))
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="alert alert-danger">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <i class="material-icons">close</i>
                                                        </button>
                                                        <span>{{ session('status') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <input type="hidden" name="id" value="{{ $payments->id }}">
                                        <br>
                                        <br>
                                        <div class="row">
                                            <div class="col-2">
                                                <h4><b>Customer Name</b></h4>
                                            </div>
                                            <div class="col-6">
                                                <h4><b>{{$payments->invoice->customer->first_name}} {{$payments->invoice->customer->last_name}}</b></h4>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-2">
                                                <h5>Invoice Id</h5>
                                            </div>
                                            <div class="col-6">
                                                <input type="text" class="form-control" name="invoice_id" value="{{$payments->invoice_id}}" style="background-color: white" readonly>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-2">
                                                <h5>Total Amount</h5>
                                            </div>
                                            <div class="col-6">
                                                <input type="text" class="form-control" name="amount" value="{{$payments->amount}}.00" id="total_amount"  style="background-color: white" readonly>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-2">
                                                <h5>Paying Amount *</h5>
                                            </div>
                                            <div class="col-6">
                                                <input type="number" class="form-control" name="paying_amount" value="{{$payments->paying_amount}}.00" id="paying_amount">
                                                @error('paying_amount')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-2">
                                                <h5>Due Amount</h5>
                                            </div>
                                            <div class="col-6">
                                                <input type="text" class="form-control" name="due_amount" value="{{$payments->due_amount}}.00" id="due_amount" style="background-color: white" readonly>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-2">
                                                <h5>Payment Mode *</h5>
                                            </div>
                                            <div class="col-6">
                                                <select name="mode" value="{{$payments->mode}}" id="mode" class="form-control">
                                                    <option value="" disabled selected hidden>Select your Payment Mode</option>
                                                    <option value="online" @if(old('mode', $payments->mode)
                                                        === 'online') selected @endif>Online</option>
                                                    <option value="cash" @if(old('mode', $payments->mode)
                                                        === 'cash') selected @endif>Cash</option>
                                                    <option value="cheque" @if(old('mode', $payments->mode)
                                                        === 'cheque') selected @endif>Cheque</option>
                                                </select>
                                                @error('mode')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-2">
                                                <h5>Paying Date *</h5>
                                            </div>
                                            <div class="col-6">
                                                <input type="date" name="date" value="{{$payments->date}}" class="form-control">
                                                @error('date')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                    <br>
                                    <div class="card-footer ml-auto mr-auto">
                                        <button class="btn btn-primary">Update</button>
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
<script type="text/javascript">
    $(document).ready(function(){
        $('#paying_amount').keyup(function(){
            var pAmount = $('#paying_amount').val();
            var tAmount = $('#total_amount').val();
            due = tAmount - pAmount;
            $('#due_amount').val(due.toFixed(2));
        });
    });
</script>
@endsection