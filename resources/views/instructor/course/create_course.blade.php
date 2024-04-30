@extends('instructor.instructor_master')
@section('title', 'Create Course')
@section('instructor')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<!-- Include Flatpickr styles and scripts -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<div class="sa4d25">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="st_title"><i class="uil uil-analysis"></i> @yield('title')</h2>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
        <form action="{{ route('store.course') }}" method="post"  enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="step-content">
                        <div class="step-tab-panel step-tab-info active" id="tab_step1">
                            <div class="tab-from-content">
                                <div class="course__form">
                                    <div class="general_info10">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="ui search focus mt-30 lbel25">
                                                    <label>Course Title <span class="text-danger"> *</span></label>
                                                    <div class="ui left icon input swdh19">
                                                        <input class="prompt srch_explore" type="text" placeholder="Course title here" name="course_title" >															
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="ui search focus mt-30 lbel25">
                                                    <label>Course Name <span class="text-danger"> *</span></label>
                                                    <div class="ui left icon input swdh19">
                                                        <input class="prompt srch_explore" type="text" placeholder="Course title here" name="course_name" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="mt-30 lbel25">
                                                    <label>Course Category <span class="text-danger"> *</span></label>
                                                </div>
                                                <select name="category_id" id="category_id" class="myselect ui hj145 dropdown cntry152 prompt srch_explore" style="border-radius: 3px; border: 1px; height: 40px; width: 490px;">
                                                    <option value="" selected="" disabled="">-- Select --</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="mt-30 lbel25">
                                                    <label>Course Subcategory <span class="text-danger"> *</span></label>
                                                </div>
                                                <select name="subcategory_id" id="subcategory_id" class="myselect ui hj145 dropdown cntry152 prompt srch_explore" style="border-radius: 3px; border: 1px; height: 40px; width: 490px;">
                                                    <option value="" selected="" disabled="">-- Select --</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="ui search focus mt-30 lbel25">
                                                    <label>Course Image <span class="text-danger"> *</span></label>
                                                    <div class="ui left icon input swdh19">
                                                        <input class="prompt srch_explore" name="course_image" type="file" id="image" placeholder="Course title here">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="ui search focus mt-30 lbel25">
                                                    <label>Course Image <span class="text-danger"> *</span></label>
                                                    <div class="ui left icon input swdh19">
                                                        <img id="showImage" src="{{ url('upload/no_image.jpg')}}" alt="Course Image"  style="width:100px; height: 50px;">  
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="ui search focus mt-30 lbel25">
                                                    <label>Short Video Intro <span class="text-danger"> *</span></label>
                                                    <div class="ui left icon input swdh19">
                                                        <input type="file" name="video" accept="video/mp4">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="mt-30 lbel25">
                                                    <label>Certificate Available <span class="text-danger"> *</span></label>
                                                </div>
                                                <select name="certificate" id="certificate" class="myselect ui hj145 dropdown cntry152 prompt srch_explore" style="border-radius: 3px; border: 1px; height: 40px; width: 490px;">
                                                    <option value="" selected="" disabled="">-- Select --</option>
                                                    <option value="yes"> Yes</option>
                                                    <option value="no"> No</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="mt-30 lbel25">
                                                    <label>Course Level<span class="text-danger"> *</span></label>
                                                </div>
                                                <select name="level" class="ui hj145 dropdown cntry152 prompt srch_explore">
                                                    <option value="">Select Level</option>
                                                    <option value="beginner">Beginner</option>
                                                    <option value="intermediate">Intermediate</option>
                                                    <option value="expert">Expert</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="ui search focus mt-30 lbel25">
                                                    <label>Course Price <span class="text-danger"> *</span></label>
                                                    <div class="ui left icon input swdh19">
                                                        <input class="prompt srch_explore" type="text" placeholder="Course Price" name="selling_price" id="course_price_input" >
                                                    </div>
                                                </div>
                                            </div>  
        
               <!-- Switch button for discount -->
            <div class="col-lg-6 col-md-6">
            <div class="ui search focus mt-30 lbel25">
                <label>Set Discount</label>
                <div class="ui checkbox">
                    <input type="checkbox" id="set_discount_switch" name="set_discount">
                    <label for="set_discount_switch"></label>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6 col-md-6">
            <div class="ui search focus mt-30 lbel25">
                <label>Course Discount Price <span class="text-danger"> *</span></label>
                <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="text" placeholder="Course Discount Price" name="discount_price" id="course_discount_price_input" >
                </div>
            </div>
        </div>



        <!-- Display the discount_expiry_date field conditionally -->
        <div class="col-lg-6 col-md-6" style="display: none;" id="discount_expiry_date_container">
            <div class="ui search focus mt-30 lbel25">
                <label>Discount Expiry Date <span class="text-danger"> *</span></label>
                <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="text" placeholder="Discount Expiry Date" name="discount_expiry_date" id="discount_expiry_date">
                </div>
            </div>
        </div>

                                            <!-- <div class="col-lg-6 col-md-6">
                                                <div class="ui search focus mt-30 lbel25">
                                                    <label>Video Duration Time <span class="text-danger">*</span></label>
                                                    <div class="ui left icon input swdh19">
                                                        <input class="prompt srch_explore" type="text" placeholder="Video Duration Time" name="duration">
                                                    </div>
                                                </div>
                                            </div> -->
                                            <div class="col-lg-6 col-md-6">
                                                <div class="ui search focus mt-30 lbel25">
                                                    <label>Resources <span class="text-danger"> *</span></label>
                                                    <div class="ui left icon input swdh19">
                                                        <input class="prompt srch_explore" type="text" placeholder="Video Duration Time" name="resources">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="ui search focus lbel25 mt-30">
                                                    <label> Course Prerequisites <span class="text-danger"> *</span></label>
                                                    <div class="ui form swdh30">
                                                        <div class="field">
                                                            <textarea rows="2" name="prerequisites" id="" placeholder="prerequisites here..."></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="ui search focus lbel25 mt-30">
                                                    <label>Course Description <span class="text-danger"> *</span></label>
                                                    <div class="ui form swdh30">
                                                        <div class="field">
                                                            <textarea name="description" id="ckeditor"  placeholder="Course Description here..."></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Course Goals Section -->
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <h2 class="text-center mt-5">Course Goals</h2>
                                                    </div>
                                                </div>
                                                <!-- Goal Option -->
                                                <div class="row add_item">
                                                    <div class="col-lg-10 col-md-10">
                                                        <div class="form-group">
                                                            <label for="goals">Goals <span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" id="goals" name="course_goals[]" placeholder="Goal" >
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-success addeventmore" type="button"><i class="fa fa-plus-circle"></i> Add More..</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!---end row-->
                                            </div>
                                            <br>
                                            <!-- End Course Goals Section -->
                                            <hr>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="ui form mt-3 checkbox_sign">
                                                            <div class="inline field">
                                                                <div class="ui checkbox mncheck">
                                                                    <input type="checkbox"  name="bestseller" value="1" id="bestsellerCheckbox" tabindex="0" >
                                                                    <label>BestSeller</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="ui form mt-3 checkbox_sign">
                                                            <div class="inline field">
                                                                <div class="ui checkbox mncheck">
                                                                    <input type="checkbox"  name="featured" value="1" id="featuredCheckbox" tabindex="0" class="hidden">
                                                                    <label>Featured</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="ui form mt-3 checkbox_sign">
                                                            <div class="inline field">
                                                                <div class="ui checkbox mncheck">
                                                                    <input type="checkbox"  name="highestrated" value="1" id="highestratedCheckbox" tabindex="0" class="hidden">
                                                                    <label>Highest Rated</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="step-footer step-tab-pager mt-5">
                                                <div class="text-right">
                                                    <button data-direction="finish" class="btn btn-default steps_btn">Submit</button>
                                                </div>
                                            </div>
        </form>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
    </div>
</div>
<!--========== Start of add multiple class with ajax ==============-->
<div style="visibility: hidden">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
        <div class="whole_extra_item_delete">
            <div class="container mt-2">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="goals">Goals</label>
                        <input type="text" name="course_goals[]" id="goals" class="form-control" placeholder="Goals">
                    </div>
                    <div class="form-group col-md-6" style="padding-top: 30px">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle"></i> Add</button>
                            <button type="button" class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle"></i> Remove</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!----For Section-------->
<script type="text/javascript">
    $(document).ready(function(){
        var counter = 0;
        $(document).on("click", ".addeventmore", function(){
            var whole_extra_item_add = $("#whole_extra_item_add").html();
            $(this).closest(".add_item").append(whole_extra_item_add);
            counter++;
        });
    
        $(document).on("click", ".removeeventmore", function(event){
            $(this).closest(".whole_extra_item_delete").remove();
            counter -= 1;
        });
    });
</script>
<!--========== End of add multiple class with ajax ==============-->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        $('#category_id').on('change', function () {
            var categoryId = $(this).val();
            if (categoryId) {
                $.ajax({
                    type: 'GET',
                    url: '/course/getSubcategories/' + categoryId,
                    success: function (data) {
                        $('#subcategory_id').empty();
                        $('#subcategory_id').append('<option selected="" disabled>Select Course Subcategory</option>');
                        $.each(data, function (key, value) {
                            $('#subcategory_id').append('<option value="' + value.id + '">' + value.subcategory_name + '</option>');
                        });
                    }
                });
            } else {
                $('#subcategory_id').empty();
                $('#subcategory_id').append('<option selected="" disabled>Select Course Subcategory</option>');
            }
        });
    });
</script>
<script type="text/javascript">
    $(".myselect").select2();
</script> 
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Function to handle numeric input validation
        function handleNumericInput(inputId) {
            var inputElement = document.getElementById(inputId);
    
            // Add an input event listener to validate the input
            inputElement.addEventListener('input', function () {
                // Remove non-numeric characters and ensure that the value is a valid number
                var numericValue = this.value.replace(/[^0-9.]/g, '');
    
                // Update the input value with the cleaned numeric value
                this.value = numericValue;
            });
        }
    
        // Apply the function to the 'course_price_input'
        handleNumericInput('course_price_input');
    
        // Apply the function to the 'course_discount_price_input'
        handleNumericInput('course_discount_price_input');
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var coursePriceInput = document.getElementById('duration');
    
        coursePriceInput.addEventListener('input', function () {
            var inputValue = coursePriceInput.value;
    
            // Remove any characters that are not numbers or semicolons
            coursePriceInput.value = inputValue.replace(/[^0-9:]/g, '');
        });
    });
</script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'ckeditor' );
</script>


<script>
    $(document).ready(function () {
        // Initialize Flatpickr for the discount_expiry_date field
        flatpickr("#discount_expiry_date", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });

        var discountPriceInput = document.getElementById('course_discount_price_input');
        var discountExpiryDateContainer = document.getElementById('discount_expiry_date_container');
        var setDiscountSwitch = document.getElementById('set_discount_switch');

        // Function to toggle visibility of Course Discount Price field
        function toggleDiscountPriceVisibility(show) {
            discountPriceInput.closest('.col-lg-6').style.display = show ? 'block' : 'none';
        }

        setDiscountSwitch.addEventListener('change', function () {
            // If the switch is turned on
            if (this.checked) {
                // Set a default discount price (you can change this value)
                discountPriceInput.value = "10"; // Change this to your default discount value

                // Show the discount_expiry_date field
                discountExpiryDateContainer.style.display = 'block';

                // Show the Course Discount Price field
                toggleDiscountPriceVisibility(true);
            } else {
                // If the switch is turned off, clear the discount price
                discountPriceInput.value = "";

                // Hide the discount_expiry_date field
                discountExpiryDateContainer.style.display = 'none';

                // Hide the Course Discount Price field
                toggleDiscountPriceVisibility(false);
            }
        });

        // Initial check on page load
        toggleDiscountPriceVisibility(setDiscountSwitch.checked);
    });
</script>


@endsection
