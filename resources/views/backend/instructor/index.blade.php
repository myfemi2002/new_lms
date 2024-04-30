@extends('admin.admin_master')
@section('title', 'Instructor')
@section('admin')
<div class="content container-fluid">
    <div class="page-header">
        <div class="content-page-header">
            <h5>@yield('title')</h5>
            <div class="list-btn">
                <ul class="filter-list">
                    <li>
                        <a class="btn btn-filters w-auto popup-toggle"><span class="me-2"><i class="fe fe-filter"></i></span>Filter </a>
                    </li>
                    <li>
                        <a class="active btn-filters" href="javascript:void(0);"><span><i class="fe fe-list"></i></span> </a>
                    </li>
                    <li>
                        <a class="btn-filters" href="javascript:void(0);"><span><i class="fe fe-grid"></i></span> </a>
                    </li>
                    <li>
                        <div class="dropdown dropdown-action">
                            <a href="#" class="btn-filters" data-bs-toggle="dropdown" aria-expanded="false"><span><i class="fe fe-download"></i></span></a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <ul class="d-block">
                                    <li>
                                        <a class="d-flex align-items-center download-item" href="javascript:void(0);" download><i class="far fa-file-pdf me-2"></i>PDF</a>
                                    </li>
                                    <li>
                                        <a class="d-flex align-items-center download-item" href="javascript:void(0);" download><i class="far fa-file-text me-2"></i>CVS</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a class="btn-filters" href="javascript:void(0);"><span><i class="fe fe-printer"></i></span> </a>
                    </li>
                    <li>
                        <a class="btn btn-import" href="javascript:void(0);"><span><i class="fe fe-check-square me-2"></i>Import Customer</span></a>
                    </li>
                    <li>
                        <a class="btn btn-primary" href="add-customer.html"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Add Customer</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="filter_inputs" class="card filter-card">
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-table">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-center table-hover datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Gender </th>
                                    <th>Country</th>
                                    <th>Created</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($allData as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="#" class="avatar avatar-md me-2"><img class="avatar-img rounded-circle" src="{{ (!empty($item->photo)) ? url('upload/instructor_images/'.$item->photo):url('upload/no_image.jpg') }}" alt="User Image"></a>
                                            <a href="#">{{ $item->name }}<span><span class="__cf_email__" data-cfemail="bed4d1d6d0fedbc6dfd3ced2db90ddd1d3">{{ $item->email }}</span></span></a>
                                        </h2>
                                    </td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ ucfirst($item->gender) }}</td>
                                    <td>{{ $item->country }}</td>
                                    <td>
                                    @if($item->created_at == NULL)<span class="text-danger">No Date Set</span>
                                    @else
                                    {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                    @endif
                                    </td>
                                    <td class="text-center"> 
                                        @if($item->status == '0')
                                        <span class="badge badge-pill bg-danger-light">Deactive</span>
                                        @elseif($item->status == '1')
                                        <span class="badge badge-pill bg-success-light">Active</span>
                                        @endif
                                    </td>
                                    <td class="d-flex align-items-center">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('activate.instructor',$item->id) }}"><i class="far fa-bell me-2"></i>Active</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('deactivate.instructor',$item->id) }}"><i class="far fa-bell-slash me-2"></i>Deactivate</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
