@extends('layouts.app', ['activePage' => 'todo', 'titlePage' => __('Add Todo')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{ route('add_todo') }}" autocomplete="off" class="form-horizontal">
                    @csrf
                    @method('put')
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ __('Add Todo') }}</h4>
                            <p class="card-category">{{ __('Todo information') }}</p>
                        </div>
                        <div class="card-body ">
                            <br>
                            <div class="row">
                                <div class="col-sm-2">
                                    <h4>Task Name</h4>
                                </div>
                                <div class="col-sm-8">
                                    <input name="name" class="form-control" id="input-name" type="text"
                                        placeholder="{{ __('Task Name') }}"/>
                                    @error('name')
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
                                    <input name="description" class="form-control" id="input-name" type="text"
                                        placeholder="{{ __('Description') }}"/>
                                    @error('description')
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