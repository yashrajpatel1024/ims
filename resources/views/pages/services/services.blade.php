@extends('layouts.app', ['activePage' => 'services', 'titlePage' => __('Services')])

@section('content')
    <!-- User Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Services</h4>
                            <p class="card-category"> Here you can show Services</p>
                        </div>
                        <div class="card-body">
                            @if (session('status'))
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="alert alert-success">
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                            <i class="material-icons">close</i>
                                                        </button>
                                                        <span>{{ session('status') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ route('add_services') }}" class="btn btn-primary">Add Services</a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <tr>
                                            <th>
                                                Id
                                            </th>
                                            <th>
                                                Services Name
                                            </th>
                                            <th>
                                                Services Description
                                            </th>
                                            <th>
                                                Cost
                                            </th>
                                            <th class="text-right">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    @if(count($services)>0)
                                    @foreach ($services as $service)
                                        <tr>
                                            <td>{{ $service->id}}</td>
                                            <td>{{ $service->service_name}}</td>
                                            <td>{{ $service->description}}</td>
                                            <td>{{'₹'.number_format($service->cost)}}</td>
                                            <td class="text-right">
                                              <div class="dropdown">
                                                  <button class="btn btn-success dropdown-toggle" type="button"
                                                      id="dropdownMenuButton" data-toggle="dropdown"
                                                      aria-haspopup="true" aria-expanded="false">
                                                  </button>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                      <a class="dropdown-item" href='{{"services_edit/".$service["id"]}}'><i
                                                              class="material-icons">edit</i>Edit</a>
                                                      <a class="dropdown-item" onclick="return confirm('Are you sure?')"  href='{{"services_delete/".$service["id"]}}'><i
                                                              class="material-icons">delete</i>Delete</a>
                                                  </div>
                                              </div>
                                          </td>
                                        </tr>
                                    @endforeach
                                    @else
                                    <tr><td colspan="8" style="text-align: center;"><strong>No Data Available in Table</strong></td></tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End User Content -->
@endsection
