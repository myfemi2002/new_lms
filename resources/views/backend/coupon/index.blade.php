@extends('admin.admin_master')
@section('title', 'Coupon')
@section('admin')


<div class="content container-fluid">
    <div class="page-header">
        <div class="content-page-header ">
            <h5>@yield('title') </h5>
            <div class="list-btn">
                <ul class="filter-list">
                    <li>
                        <a class="btn btn-filters w-auto popup-toggle"><span class="me-2"><i class="fe fe-filter"></i></span>Filter </a>
                    </li>
                    <li>
                        <a class="btn-filters" href="javascript:void(0);"><span><i class="fe fe-grid"></i></span> </a>
                    </li>
                    <li>
                        <a class="active btn-filters" href="javascript:void(0);"><span><i class="fe fe-list"></i></span> </a>
                    </li>
                    <li class>
                        <div class="dropdown dropdown-action">
                            <a href="#" class="btn-filters" data-bs-toggle="dropdown" aria-expanded="false"><span><i class="fe fe-download"></i></span></a>
                            <div class="dropdown-menu dropdown-menu-right">
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
                        <a class="btn btn-primary" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#add_category"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Add @yield('title')</a>
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
            <div class=" card-table">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-center table-hover datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Coupon Name</th>
                                    <th>Coupon Discount</th>
                                    <th>Coupon Validity</th>
                                    <th>Coupon Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allData as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->coupon_name }}</td>
                                    <!-- <td>{{ ucfirst($item->coupon_discount) }}</td> -->
                                    <td>{{ $item->coupon_discount }}%</td> 
                                    <td> {{ Carbon\Carbon::parse($item->coupon_validity)->format('D, d F Y')  }} </td>
                                    <td>  
                                        @if ($item->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                        <span class="badge badge-pill bg-success-light">Valid</span>   
                                        @else 
                                        <span class="badge badge-pill bg-danger-light">Invalid</span>
                                        @endif
                                    </td>

                                    <td class="d-flex align-items-center">
                                        <a class=" btn-action-icon me-2" href="#" data-bs-toggle="modal" data-bs-target="#edit_coupon{{ $item->id }}"><i class="fe fe-edit"></i></a>

                                        <a class=" btn-action-icon" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_coupon{{ $item->id }}"><i class="fe fe-trash-2"></i></a>
                                    </td>
                                </tr>

                                <!-- deleete category -->
                                    <div class="modal custom-modal fade" id="delete_coupon{{ $item->id }}" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="form-header">
                                                        <h3>Delete @yield('title')</h3>
                                                        <p>Are you sure want to delete?</p>
                                                    </div>
                                                    <div class="modal-btn delete-action">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <a href="{{ route('admin.delete.coupon', $item->id) }}" class="w-100 btn btn-primary paid-continue-btn">Delete</a>
                                                            </div>

                                                            <div class="col-6">
                                                                <button type="submit" data-bs-dismiss="modal" class="w-100 btn btn-primary paid-cancel-btn">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                
                                    <!-- edit category -->
                                    <div class="modal custom-modal fade" id="edit_coupon{{ $item->id }}" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header border-0 pb-0">
                                                    <div class="form-header modal-header-title text-start mb-0">
                                                        <h4 class="mb-0">Edit @yield('title')</h4>
                                                    </div>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span class="align-center" aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <form id="myForm" method="post" action="{{ route('admin.update.coupon', ['id' => $item->id]) }}" enctype="multipart/form-data">@csrf
                                                     
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="card-body">
                                                                    <div class="form-group-item border-0 pb-0 mb-0">
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label>Name <span class="text-danger">*</span></label>
                                                                                    <input type="text" class="form-control @error('coupon_name') is-invalid @enderror" name="coupon_name" value="{{ $item->coupon_name }}" placeholder="Enter Coupon Name" required>
                                                                                    @error('coupon_name')
                                                                                        <span class="invalid-feedback" role="alert">
                                                                                            <strong>{{ $message }}</strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-12 col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label>Discount <span class="text-danger">*</span></label>
                                                                                    <input type="text" class="form-control @error('coupon_discount') is-invalid @enderror" name="coupon_discount" value="{{ $item->coupon_discount }}" placeholder="Enter Coupon Discount" required>
                                                                                    @error('coupon_discount')
                                                                                        <span class="invalid-feedback" role="alert">
                                                                                            <strong>{{ $message }}</strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-12 col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label>Validity <span class="text-danger">*</span></label>
                                                                                    <input type="text" class="form-control @error('coupon_validity') is-invalid @enderror datetimepicker" name="coupon_validity" value="{{ $item->coupon_validity }}" placeholder="DD-MM-YYYY" required>
                                                                                    @error('coupon_validity')
                                                                                        <span class="invalid-feedback" role="alert">
                                                                                            <strong>{{ $message }}</strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-12 col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label>Status</label>
                                                                                    <select class="form-control @error('status') is-invalid @enderror" name="status">
                                                                                        <option value="1" {{ $item->status == '1' ? 'selected' : '' }}>Active</option>
                                                                                        <option value="0" {{ $item->status == '0' ? 'selected' : '' }}>Inactive</option>
                                                                                    </select>
                                                                                    @error('status')
                                                                                        <span class="invalid-feedback" role="alert">
                                                                                            <strong>{{ $message }}</strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Modal footer with buttons -->
                                                        <div class="modal-footer">
                                                            <a href="#" data-bs-dismiss="modal" class="btn btn-primary paid-cancel-btn me-2">Cancel</a>
                                                            <button type="submit" class="btn btn-primary paid-continue-btn">Update</button>
                                                        </div>
                                                    </form>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<!-- add coupon -->
<div class="modal custom-modal fade" id="add_category" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="mb-0">Add Coupon</h4>
                </div>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span class="align-center" aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
            <form id="myForm" method="post" action="{{ route('admin.store.coupon') }}" enctype="multipart/form-data">@csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="form-group-item border-0 pb-0 mb-0">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('coupon_name') is-invalid @enderror" name="coupon_name" value="{{ old('coupon_name') }}" placeholder="Enter Coupon Name" required>
                                            @error('coupon_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Discount <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('coupon_discount') is-invalid @enderror" name="coupon_discount" value="{{ old('coupon_discount') }}" placeholder="Enter Coupon Discount" required>
                                            @error('coupon_discount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Validity <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('coupon_validity') is-invalid @enderror datetimepicker" name="coupon_validity" value="{{ old('coupon_validity') }}" placeholder="DD-MM-YYYY" required>
                                            @error('coupon_validity')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control @error('status') is-invalid @enderror" name="status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer with buttons -->
                <div class="modal-footer">
                    <a href="#" data-bs-dismiss="modal" class="btn btn-primary paid-cancel-btn me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary paid-continue-btn">Add Coupon</button>
                </div>
            </form>

        </div>
    </div>
</div>





@endsection
