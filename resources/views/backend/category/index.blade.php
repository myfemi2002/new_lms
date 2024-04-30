@extends('admin.admin_master')
@section('title', 'Category')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
                <p class="card-text">Category</p>
            </div>
            <div class="card-body card-buttons">
                <div class="row">
                    <div class="col-sm">
                    <form class="needs-validation" id="myForm" method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Category Name</label>
                                            <input type="text" class="form-control" placeholder="Category Name" name="category_name" required>
                                            <small class="form-control-feedback">
                                            @error('category_name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <!-- Col -->
                                <div class="col-sm-5">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Category Image</label>
                                            <input type="file" name="image" class="form-control" id="image" accept="image/*" required>

                                            <small class="form-control-feedback">
                                            @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <!-- Col -->

                                <div class="col-md-2 text-center">
                                    <img id="showImage" src="{{ url('upload/no_image.jpg') }}" alt="category-image" style="width:100px; height: 100px;"  >
                                </div>
                                                                
                                <div class="col-auto align-self-end">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
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
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Category Image</th>
                                <!-- <th>Created</th> -->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allData as $key => $item)
                            <tr class="{{ $colors[$key % count($colors)] }}">
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->category_name }}</td>
                                <td>
                                    @if($item->image == NULL)<span class="text-danger">No Image</span>
                                    @else
                                    <img src="{{ (!empty($item->image)) ? url('upload/category_images/'.$item->image):url('upload/no_image.jpg') }}" alt="Blank Image" style="height:40px; width:70px">
                                    @endif
                                </td>
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
                                        <form action="{{ route('category.update', $item->id) }}" method="POST" id="edit_category"  enctype="multipart/form-data" novalidate>
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label class="form-label">Category Name</label>
                                                    <input type="text" class="form-control" placeholder="Category Name" name="category_name" value="{{ $item->category_name }}">
                                                    @error('category_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">Category Image</label>
                                                    
                                                    <input type="file" name="image" class="form-control" id="image1" accept="image/*" required>

                                                    @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 text-center">
                                                    <img id="showImage1" src="{{ (!empty($item->image)) ? url('upload/category_images/'.$item->image):url('upload/no_image.jpg') }}" alt="category-image" style="width:100px; height: 100px;"  >
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



<!-- Body Ends-->
<script type="text/javascript">
    $(document).ready(function(){
    	$('#image').change(function(e){
    		var reader = new FileReader();
    		reader.onload = function(e){
    			$('#showImage').attr('src',e.target.result);
    		}
    		reader.readAsDataURL(e.target.files['0']);
    	});
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
    	$('#image1').change(function(e){
    		var reader = new FileReader();
    		reader.onload = function(e){
    			$('#showImage1').attr('src',e.target.result);
    		}
    		reader.readAsDataURL(e.target.files['0']);
    	});
    });
</script>


@endsection

