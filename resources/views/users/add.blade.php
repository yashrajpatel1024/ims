
@extends('layouts.app', ['activePage' => 'user', 'titlePage' => __('Add User')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{ route('add') }}" autocomplete="off" class="form-horizontal">
                    @csrf
                    @method('put')
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ __('Add User') }}</h4>
                            <p class="card-category">{{ __('User information') }}</p>
                        </div>
                        <div class="card-body ">
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
                            <br>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h4>Name</h4>
                                </div>
                                <div class="col-sm-8">
                                    <input name="name" class="form-control" id="input-name" type="text"
                                        placeholder="{{ __('Name') }}"/>
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h4>Email</h4>
                                </div>
                                <div class="col-sm-8">
                                    <input name="email" class="form-control" id="input-name" type="text"
                                        placeholder="{{ __('Email') }}"/>
                                    @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h4>Password</h4>
                                </div>
                                <div class="col-sm-8">
                                    <input class="form-control" name="password" id="input-password" type="password"
                                        placeholder="{{ __('Password') }}"/>
                                    @error('password')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h4>Confirm Password</h4>
                                </div>
                                <div class="col-sm-8">
                                    <input  class="form-control" name="password_confirmation"
                                        id="input-password-confirmation" type="password"
                                        placeholder="{{ __('Confirm New Password') }}" />
                                        @error('password_confirmation')
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