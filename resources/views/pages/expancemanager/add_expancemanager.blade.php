@extends('layouts.app', ['activePage' => 'expance', 'titlePage' => __('Add Expance')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{ route('add_expance') }}" autocomplete="off" class="form-horizontal">
                    @csrf
                    @method('put')
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ __('Add Expance') }}</h4>
                            <p class="card-category">{{ __('Expance information') }}</p>
                        </div>
                        <div class="card-body ">
                            <br>
                            <div class="row">
                                <div class="col-sm-2">
                                    <h5>Amount *</h5>
                                </div>

                                <div class="col-sm-7">
                                    <input type="number" class="form-control" name="amount" placeholder="{{ __('₹0.00') }}" >
                                    @error('amount')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-2">
                                    <h5>Catagory *</h5>
                                </div>
                                <div class="col-sm-7">
                                    <select name="catagories" class="form-control">
                                        <option value="" disabled selected hidden>Select your Catagory</option>
                                        <option value="automobile">Automobile</option>
                                        <option value="entertainment">Entertainment</option>
                                        <option value="family">Family</option>
                                        <option value="food">Food</option>
                                        <option value="office">Office</option>
                                        <option value="travel">Travel</option>
                                        <option value="loans">Loans</option>
                                        <option value="utilities">Utilities</option>
                                        <option value="vacation">Vacation</option>
                                        <option value="other">Other</option>
                                    </select>
                                    @error('catagories')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-2">
                                    <h5>Current Balance *</h5>
                                </div>

                                <div class="col-sm-7">
                                    <input type="number" class="form-control" name="current_balance" placeholder="{{ __('₹0.00') }}" >
                                    @error('current_balance')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="card-footer" style="padding-left:45%">
                                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
