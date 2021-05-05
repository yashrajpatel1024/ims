@extends('layouts.app', ['activePage' => 'services', 'titlePage' => __('Edit Service')])

@section('content')
    <!-- Edit service -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('services_edit') }}" autocomplete="off" class="form-horizontal">
                        @csrf
                        @method('put')
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Edit Service') }}</h4>
                                <p class="card-category">{{ __('Services information') }}</p>
                            </div>
                            <div class="card-body ">
                                <input type="hidden" name="id" value="{{ $services->id }}">
                                <br>
                            <div class="row">
                                <div class="col-sm-2">
                                    <h4>Service Name</h4>
                                </div>
                                <div class="col-sm-8">
                                    <input  value="{{ $services->service_name }}" class="form-control" name="service_name" type="text"
                                        placeholder="{{ __('Name') }}"/>
                                    @error('service_name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-2">
                                    <h4>Description</h4>
                                </div>
                                <div class="col-sm-8">
                                    <input value="{{ $services->description }}" class="form-control" name="description" type="text"
                                        placeholder="{{ __('Description') }}"/>
                                    @error('description')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-2">
                                    <h4>Cost</h4>
                                </div>
                                <div class="col-sm-8">
                                    <input value="{{ $services->cost }}" class="form-control" name="cost" type="text"
                                        placeholder="{{ __('Cost') }}"/>
                                    @error('cost')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="card-footer"  style="padding-left:45%">
                                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Edit Service -->

@endsection
