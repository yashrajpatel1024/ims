@extends('layouts.app', ['activePage' => 'user', 'titlePage' => __('Edit User')])

@section('content')
    <!-- Edit Profile -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('edit') }}" autocomplete="off" class="form-horizontal">
                        @csrf
                        @method('put')
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Edit Profile') }}</h4>
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
                                <input type="hidden" name="id" value="{{ $users['id'] }}">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h4>Name</h4>
                                    </div>
                                    <div class="col-sm-8">
                                        <input value="{{ $users['name'] }}" class="form-control" required="true" name="name" id="input-name"
                                            size="50%" type="text" placeholder="{{ __('Name') }}" required="true"
                                            aria-required="true" />
                                        @if ($errors->has('name'))
                                            <span id="name-error" class="error text-danger"
                                                for="input-name">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h4>Email</h4>
                                    </div>
                                    <div class="col-sm-8">
                                        <input value="{{ $users['email'] }}" class="form-control" required="true" name="email" id="input-name"
                                            size="50%" type="text" placeholder="{{ __('Email') }}" required="true"
                                            aria-required="true" />
                                        @if ($errors->has('email'))
                                            <span id="name-error" class="error text-danger"
                                                for="input-name">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="card-footer" style="padding-left:45%">
                                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Edit Profile -->
            <!-- Change Password -->
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('profile.password') }}" class="form-horizontal">
                        @csrf
                        @method('put')
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Change password') }}</h4>
                                <p class="card-category">{{ __('Password') }}</p>
                            </div>
                            <div class="card-body ">
                                @if (session('status_password'))
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <i class="material-icons">close</i>
                                                </button>
                                                <span>{{ session('status_password') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h4>Current Password</h4>
                                    </div>
                                    <div class="col-sm-6">
                                        <input size="70%" type="password" class="form-control" name="old_password" id="input-current-password"
                                            placeholder="{{ __('Current Password') }}" value="" required />
                                        @if ($errors->has('old_password'))
                                            <span id="name-error" class="error text-danger"
                                                for="input-name">{{ $errors->first('old_password') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h4>New Password</h4>
                                    </div>
                                    <div class="col-sm-6">
                                        <input size="70%" class="form-control" name="password" id="input-password" type="password"
                                            placeholder="{{ __('New Password') }}" value="" required />
                                        @if ($errors->has('password'))
                                            <span id="password-error" class="error text-danger"
                                                for="input-password">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h4>Confirm New Password</h4>
                                    </div>

                                    <div class="col-sm-6">

                                        <input size="70%" class="form-control" name="password_confirmation" id="input-password-confirmation"
                                            type="password" placeholder="{{ __('Confirm New Password') }}" value=""
                                            required />
                                    </div>
                                </div>
                                <div class="card-footer" style="padding-left:41%">
                                    <button type="submit" class="btn btn-primary">{{ __('Change password') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Change Password -->
@endsection
