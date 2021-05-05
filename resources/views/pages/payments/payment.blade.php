@extends('layouts.app', ['activePage' => 'payments', 'titlePage' => __('Payment')])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Payment</h4>
                <p class="card-category"> Here you can Pay</p>
            </div>
            <form method="post" action="{{ route('add_payments') }}" autocomplete="off"class="form-horizontal">
            	@csrf
            	@method('put')
            	<div class="card-body">
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
            		<br>
            		<br>
            		<div class="row">
            			<div class="col-2">
            				<h5>Invoice Id</h5>
            			</div>
            			<div class="col-6">
            				<input type="text" class="form-control" value="{{$invoices->id}}" style="background-color: white" readonly>
            			</div>
            		</div>
            		<br>
            		<div class="row">
            			<div class="col-2">
            				<h5>Total Amount</h5>
            			</div>
            			<div class="col-6">
            				<input type="text" class="form-control" name="amount" value="{{$invoices->total}}.00" id="total_amount" style="background-color: white" readonly>
            			</div>
            		</div>
            		<br>
            		<div class="row">
            			<div class="col-2">
            				<h5>Paying Amount *</h5>
            			</div>
            			<div class="col-6">
            				<input type="number" class="form-control" name="paying_amount" placeholder="0.00" id="paying_amount">
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
            				<input type="text" class="form-control" name="due_amount" placeholder="0.00" id="due_amount" style="background-color: white" readonly>
            			</div>
            		</div>
            		<br>
            		<div class="row">
            			<div class="col-2">
            				<h5>Payment Mode *</h5>
            			</div>
            			<div class="col-6">
            				<select name="mode" id="mode" class="form-control">
            	                <option value="" disabled selected hidden>Select your Payment Mode</option>
            	                <option value="online">Online</option>
            	                <option value="cash">Cash</option>
            	                <option value="cheque">Cheque</option>
            	            </select>
                            @error('payment_mode')
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
            				<input type="date" name="date" class="form-control">
                            @error('paying_date')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
            			</div>
            		</div>
            		<br>
            		<div class="card-footer" style="padding-left:45%">
            	        <button class="btn btn-primary">Submit</button>
            	    </div>
            	</div>
        	</form>
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