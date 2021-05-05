@extends('layouts.app', ['activePage' => 'todo', 'titlePage' => __('Edit Todo')])

@section('content')
    <!-- Edit todo -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('edit_todo') }}" autocomplete="off" class="form-horizontal">
                        @csrf
                        @method('put')
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Edit Todo') }}</h4>
                                <p class="card-category">{{ __('Todo information') }}</p>
                            </div>
                            <div class="card-body ">
                                <input type="hidden" name="id" value="{{ $todos->id }}">
                            <div class="row">
                                <div class="col-sm-2">
                                    <h4>Name</h4>
                                </div>
                                <div class="col-sm-8">
                                    <input  value="{{ $todos->name }}" class="form-control" name="name" id="input-name" type="text"
                                        placeholder="{{ __('Name') }}"/>
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
                                    <input  value="{{ $todos->description }}" class="form-control" name="description" id="input-name" type="text"
                                        placeholder="{{ __('Description') }}"/>
                                    @error('description')
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
    <!-- End Edit todo -->

@endsection
