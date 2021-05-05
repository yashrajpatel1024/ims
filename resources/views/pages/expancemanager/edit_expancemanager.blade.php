@extends('layouts.app', ['activePage' => 'expance', 'titlePage' => __('Edit Expance')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{ route('edit_expance') }}" autocomplete="off" class="form-horizontal">
                    @csrf
                    @method('put')
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ __('Edit Expance') }}</h4>
                            <p class="card-category">{{ __('Expance information') }}</p>
                        </div>
                        <div class="card-body ">
                            <input type="hidden" name="id" value="{{ $expancemanagers->id }}">
                            <br>
                            <div class="row">
                                <div class="col-sm-2">
                                    <h5>Amount *</h5>
                                </div>
                                <div class="col-sm-7">
                                    <input type="number" name="amount" class="form-control" id="input-name" placeholder="{{ __('Amount') }}" 
                                    value="{{ $expancemanagers->amount }}.00"/>
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
                                    <select name="catagories" class="form-control" value="{{ $expancemanagers->catagories }}">
                                        <option value="" disabled selected hidden>Select your Catagory
                                        </option>
                                        <option value="automobile" @if(old('catagories', $expancemanagers->catagories)
                                            === 'automobile') selected @endif>Automobile</option>
                                        <option value="entertainment" @if(old('catagories', $expancemanagers->
                                            catagories) === 'entertainment') selected @endif>Entertainment</option>
                                        <option value="family" @if(old('catagories', $expancemanagers->catagories) ===
                                            'family') selected @endif>Family</option>
                                        <option value="food" @if(old('catagories', $expancemanagers->catagories) ===
                                            'food') selected @endif>Food</option>
                                        <option value="office" @if(old('catagories', $expancemanagers->catagories) ===
                                            'office') selected @endif>Office</option>
                                        <option value="travel" @if(old('catagories', $expancemanagers->catagories) ===
                                            'travel') selected @endif>Travel</option>
                                        <option value="loans" @if(old('catagories', $expancemanagers->catagories) ===
                                            'loans') selected @endif>Loans</option>
                                        <option value="utilities" @if(old('catagories', $expancemanagers->catagories)
                                            === 'utilities') selected @endif>Utilities</option>
                                        <option value="vacation" @if(old('catagories', $expancemanagers->catagories) ===
                                            'vacation') selected @endif>Vacation</option>
                                        <option value="other" @if(old('catagories', $expancemanagers->catagories) ===
                                            'other') selected @endif>Other</option>
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
                                    <input type="number" value="{{ $expancemanagers->current_balance }}.00" class="form-control"  name="current_balance"
                                        placeholder="{{ __('₹0.00') }}">
                                    @error('current_balance')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="card-footer" style="padding-left:45%">
                                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
