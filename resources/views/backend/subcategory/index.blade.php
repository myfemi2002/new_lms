@extends('admin.admin_master')
@section('title', 'Sub Category')
@section('admin')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

<div class="page-header">
    <div class="content-page-header">
        <h5>@yield('title')</h5>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 mx-auto">
        <div class="card">
            <div class="card-header card-buttons">
                <h5 class="card-title">@yield('title')</h5>
                <p class="card-text">Category and Sub Category</p>
            </div>
            <div class="card-body card-buttons">
                <div class="row">
                    <div class="col-sm">
                        <form class="needs-validation" id="myForm" method="POST" action="{{ route('subcategory.store') }}" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row">
                                    <div class="col">
                                            <label class="form-label">Sub Category Name</label>
                                            <input type="text" class="form-control" placeholder="Subcategory Name" name="subcategory_name" required>
                                            <small class="form-control-feedback">
                                            @error('subcategory_name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <!-- Col -->

                                <div class="col-sm-6">
                                    <div class="row">  
                                        <div class="col">
                                            <label class="form-label">Category Name</label>
                                            <select class="form-control form-small select" name="category_id" required>
                                                <option value="" selected="" disabled="">Open this select menu</option>
                                                @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                            <small class="form-control-feedback">
                                            @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </small>
                                        </div>

                                        <div class="col-auto align-self-end">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Col -->
                            </div>
                            <!-- Row -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">@yield('title')</h5>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                    <table id="examp" class="cell-border" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Sub Category Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subcategories as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item['category']['category_name'] }}</td>
                                <td>{{ $item->subcategory_name }}</td>
                                
                                <td>
                                    <button class="btn btn-sm btn-primary" title="Edit Data" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">Edit Data</button>
                                    <button class="btn btn-sm btn-danger" title="Delete Data" id="delete_data" href="{{ route('category.delete', $item->id) }}">Delete</button>
                                </td>
                            </tr>
                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit @yield('title')</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('subcategory.update', $item->id) }}" method="POST" id="edit_category"  enctype="multipart/form-data" novalidate>
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label class="form-label">Sub Category Name</label>
                                                    <input type="text" class="form-control" placeholder="Subcategory Name" name="subcategory_name" value="{{ $item->subcategory_name }}" required>
                                                    <small class="form-control-feedback">
                                                    @error('subcategory_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    </small>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">Category Name</label>
                                                    <select class="form-control form-small select" name="category_id" required>
                                                        <option value="" selected disabled>Open this select menu</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->id }}" {{ $category->id == $item->category_id ? 'selected' : '' }}>
                                                                {{ $category->category_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <small class="form-control-feedback">
                                                        @error('category_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </small>
                                                </div>


                                                
                                                
                                            </div>
                                            <div class="modal-footer mt-2">
                                                <button type="submit" class="btn btn-danger">Update Changes</button>
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
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

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
    $('#examp').DataTable();
    });
</script>

@endsection
