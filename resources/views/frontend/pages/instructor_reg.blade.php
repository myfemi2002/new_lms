@extends('frontend.master_home')
@section('home_content')
@section('title', 'Home')
<!--======================================
    START REGISTER AREA
    ======================================-->
<section class="register-area section--padding dot-bg overflow-hidden">
    <div class="container">
        <div class="register-heading-content-wrap text-center">
            <div class="section-heading">
                <h2 class="section__title">Fill Up this Form to Join with Us</h2>
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
            <!-- end section-heading -->
        </div>
        <div class="row pt-50px">
            <div class="col-lg-10 mx-auto">
                <div class="card card-item">
                    <div class="card-body">
                        <form method="POST" action="{{ route('become.instructor.store') }}"  class="row">
                            @csrf
                            <div class="input-box col-lg-6">
                                <label class="label-text">First Name</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="text" name="name" placeholder="e.g. Alex">
                                    <span class="la la-user input-icon"></span>
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end input-box -->
                            <div class="input-box col-lg-6">
                                <label class="label-text">Username</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="text" name="username" placeholder="e.g. Smith2002">
                                    <span class="la la-user input-icon"></span>
                                    @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end input-box -->
                            <div class="input-box col-lg-6">
                                <label class="label-text">Password</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="password" name="password" placeholder="e.g. Smith">
                                    <span class="la la-user input-icon"></span>
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end input-box -->
                            <div class="input-box col-lg-6">
                                <label class="label-text">Email Address</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="email" name="email" placeholder="e.g. alexsmith@gmail.com">
                                    <span class="la la-envelope input-icon"></span>
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end input-box -->
                            <div class="input-box col-lg-6">
                                <label class="label-text">Address</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="text" name="address" placeholder="e.g. 12345 Little Baker St, Melbourne">
                                    <span class="la la-map-marker input-icon"></span>
                                    @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end input-box -->
                            <div class="input-box col-lg-6">
                                <label class="label-text">Phone Number</label>
                                <div class="form-group">
                                    <input id="phone" class="form-control form--control" type="text" name="phone">
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end input-box -->
                            <div class="input-box col-lg-12">
                                <label class="label-text">Birthday</label>
                                <div class="row">
                                    <div class="col-lg-4 form-group">
                                        <div class="select-container w-auto">
                                            <select class="select-container-select" name="birthday_day">
                                                <option value="0" selected="">Day</option>
                                                <!-- Add options for days dynamically in your Blade template -->
                                                @for ($day = 1; $day <= 31; $day++)
                                                <option value="{{ $day }}">{{ $day }}</option>
                                                @endfor
                                            </select>
                                            @error('birthday_day')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- end col-lg-4 -->
                                    <div class="col-lg-4 form-group">
                                        <div class="select-container w-auto">
                                            <select class="select-container-select" name="birthday_month">
                                                <option value="0" selected="">Month</option>
                                                <!-- Add options for months dynamically in your Blade template -->
                                                @for ($month = 1; $month <= 12; $month++)
                                                <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                                                @endfor
                                            </select>
                                            @error('birthday_month')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- end col-lg-4 -->
                                    <div class="col-lg-4 form-group">
                                        <div class="select-container w-auto">
                                            <select class="select-container-select" name="birthday_year">
                                                <option value="0" selected="">Year</option>
                                                <!-- Add options for years dynamically in your Blade template -->
                                                @for ($year = date('Y'); $year >= 1905; $year--)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                                @endfor
                                            </select>
                                            @error('birthday_year')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- end col-lg-4 -->
                                </div>
                                <!-- end row -->
                            </div>
                            <!-- end input-box -->
                            <div class="input-box col-lg-4">
                                <label class="label-text">Country</label>
                                <div class="form-group">
                                    <div class="select-container w-auto">
                                        <select class="select-container-select" name="country" id="countryDropdown" onchange="loadStates()">
                                            <option value="">Select Country</option>
                                            <!-- Options for Country will be dynamically loaded -->
                                            @isset($countries)
                                            @foreach($countries as $country)
                                            <option value="{{ $country }}">{{ $country }}</option>
                                            @endforeach
                                            @endisset
                                        </select>
                                        @error('country')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- end input-box -->


                            <div class="input-box col-lg-4">
                                <label class="label-text">State</label>
                                <div class="form-group">
                                    <div class="select-container w-auto">
                                        <select class="form-control form--control" id="state" name="state" onchange="loadCities()" disabled>
                                            <option value="">Select State</option>
                                            
                                        </select>
                                        <span class="la la-map input-icon"></span>
                                        @error('state')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            
                            <div class="input-box col-lg-4">
                                <label class="label-text">State</label>
                                <div class="form-group">
                                    <div class="select-container w-auto">
                                        <select class="form-control form--control" id="city" name="city" disabled>
                                            <option value="">Select City</option>
                                            
                                        </select>
                                        <span class="la la-map input-icon"></span>
                                        @error('state')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="input-box col-lg-12">
                                <label class="label-text">Select Gender</label>
                                <div class="form-group d-flex align-items-center">
                                    <div class="custom-control custom-radio fs-15 mr-3">
                                        <input type="radio" name="gender" class="custom-control-input" id="maleRadioCheck" value="male" required>
                                        @error('gender')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label class="custom-control-label custom--control-label" for="maleRadioCheck">Male</label>
                                    </div>
                                    <div class="custom-control custom-radio fs-15">
                                        <input type="radio" name="gender" class="custom-control-input" id="femaleRadioCheck" value="female" required>
                                        @error('gender')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label class="custom-control-label custom--control-label" for="femaleRadioCheck">Female</label>
                                    </div>
                                </div>
                            </div>
                            <!-- end input-box -->
                            <div class="btn-box col-lg-12">
                                <div class="custom-control custom-checkbox mb-4 fs-15">
                                    <input type="checkbox" class="custom-control-input" id="agreeCheckbox" required>
                                    <label class="custom-control-label custom--control-label" for="agreeCheckbox">by signing i agree to the
                                    <a href="terms-and-conditions.html" class="text-color hover-underline">terms and conditions</a> and
                                    <a href="privacy-policy.html" class="text-color hover-underline">privacy policy</a>
                                    </label>
                                </div>
                                <!-- end custom-control -->
                                <button id="submitButton" class="btn theme-btn" type="submit" disabled>Apply Now <i class="la la-arrow-right icon ml-1"></i></button>
                            </div>
                            <script>
                                document.getElementById('agreeCheckbox').addEventListener('change', function () {
                                    document.getElementById('submitButton').disabled = !this.checked;
                                });
                            </script>
                            <!-- end btn-box -->
                        </form>
                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col-lg-10 -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- end register-area -->
<!--======================================
    END REGISTER AREA
    ======================================-->
    <script>
    function loadStates() {
        var country = document.getElementById('countryDropdown').value;

        if (country) {
            // Make an AJAX request to fetch states
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var states = JSON.parse(xhr.responseText).states;
                    populateDropdown('state', states);
                    document.getElementById('state').disabled = false; // Enable the state dropdown
                    document.getElementById('city').disabled = true;   // Disable the city dropdown
                    resetDropdown('city');
                }
            };

            xhr.open('GET', '/get-states/' + country, true);
            xhr.send();
        } else {
            document.getElementById('state').disabled = true;  // Disable the state dropdown
            document.getElementById('city').disabled = true;   // Disable the city dropdown
            resetDropdown('state');
            resetDropdown('city');
        }
    }

    function loadCities() {
        var state = document.getElementById('state').value;

        if (state) {
            // Make an AJAX request to fetch cities
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var cities = JSON.parse(xhr.responseText).cities;
                    populateDropdown('city', cities);
                    document.getElementById('city').disabled = false;  // Enable the city dropdown
                }
            };

            xhr.open('GET', '/get-cities/' + state, true);
            xhr.send();
        } else {
            document.getElementById('city').disabled = true;  // Disable the city dropdown
            resetDropdown('city');
        }
    }

    function populateDropdown(elementId, data) {
        var dropdown = document.getElementById(elementId);
        dropdown.innerHTML = '<option value="">Select ' + elementId.charAt(0).toUpperCase() + elementId.slice(1) + '</option>';

        data.forEach(function(item) {
            var option = document.createElement('option');
            option.value = item;
            option.text = item;
            dropdown.add(option);
        });
    }

    function resetDropdown(elementId) {
        var dropdown = document.getElementById(elementId);
        dropdown.innerHTML = '<option value="">Select ' + elementId.charAt(0).toUpperCase() + elementId.slice(1) + '</option>';
        dropdown.disabled = true;
    }
</script>

@endsection
