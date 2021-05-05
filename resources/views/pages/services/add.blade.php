@extends('layouts.app', ['activePage' => 'services', 'titlePage' => __('Add service')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('add_services') }}" autocomplete="off" class="form-horizontal">
                        @csrf
                        @method('put')
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Add Service') }}</h4>
                                <p class="card-category">{{ __('Service information') }}</p>
                            </div>
                            <div class="card-body ">
                                <br>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <h4>Service Name *</h4>
                                    </div>
                                    <div class="col-sm-8">
                                        <input name="service_name" class="form-control" type="text"
                                            placeholder="{{ __('Name') }}" />
                                            @error('service_name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <h4>Description *</h4>
                                    </div>
                                    <div class="col-sm-8">
                                        <input name="description" class="form-control" type="text" placeholder="{{ __('Description') }}" />
                                        @error('description')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <h4>Cost *</h4>
                                    </div>
                                    <div class="col-sm-8">
                                        <input name="cost" class="form-control" type="number" placeholder="{{ __('Cost') }}" />
                                        @error('cost')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="card-footer" style="padding-left:45%">
                                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
