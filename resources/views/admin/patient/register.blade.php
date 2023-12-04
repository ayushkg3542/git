@extends('admin.layouts.app')

@section('content')
<main id="main" class="main leaves-bg patient-register">
    <div class="pagetitle d-flex align-items-center justify-content-center">
        <h3 class="text-primary">New Patient Registration</h3>
    </div>

    <section class="section profile">
        <form id="formData" method="POST" action="{{ route('registerPatient.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="photo_upload text-center">
                                <div class="photo_upload_inner position-relative">
                                    <img src="http://placehold.it/180" id="blah" alt="Image" class="upload">
                                    <button class="close_btn" type="button" onclick="removeImg()">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </div>
                                <label for="photo" class="custom-file-upload">Upload Photo</label>
                                <input class="inputFile" type="file" id="photo" name="photo" onchange="readUrl(this)"
                                    value="{{ old('photo') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-9">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav personal_tabs nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button type="button" id="personal-details-button" class="nav-link active"
                                        data-bs-toggle="tab" data-bs-target="#personal-details" disabled>PERSONAL
                                        DETAILS</button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" id="contact-details-button" class="nav-link"
                                        data-bs-toggle="tab" data-bs-target="#contact-details" disabled> CONTACT
                                        DETAILS</button>
                                </li>
                            </ul>

                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active personal-details" id="personal-details">
                                    <div class="row g-3">
                                        <div class="col-md-3">
                                            <div class="form-floating">
                                                <input type="text"
                                                    class="form-control @error('file_number') is-invalid @enderror"
                                                    name="file_number" id="file_number" placeholder="File Number"
                                                    value="{{ old('file_number') ? old('file_number') : $fileNo }}"
                                                    oninput="checkDuplicate()" readonly>
                                                <label for="file_number">File Number</label>
                                                <div id="duplicate-file-no" class="invalid-feedback"></div>
                                                @error('file_number')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text"
                                                    class="form-control @error('first_name') is-invalid @enderror"
                                                    name="first_name" id="first_name" placeholder="First Name"
                                                    value="{{ old('first_name') }}">
                                                <label for="first_name">First Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text"
                                                    class="form-control @error('last_name') is-invalid @enderror"
                                                    name="last_name" id="last_name" placeholder="Last Name"
                                                    value="{{ old('last_name') }}">
                                                <label for="last_name">Last Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="date"
                                                    class="form-control @error('date_of_birth') is-invalid @enderror"
                                                    name="date_of_birth" id="date_of_birth" placeholder="Date Of Birth"
                                                    value="{{ old('date_of_birth') }}" max="{{now()->format('Y-m-d')}}">
                                                <label for="date_of_birth">Date Of Birth</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <select class="form-select @error('gender') is-invalid @enderror"
                                                    aria-label="Default select example" name="gender" id="gender">
                                                    <option value="" selected>Select Gender</option>
                                                    <option @if (old('gender')=='Male') selected @endif value="Male">Male</option>
                                                    <option @if (old('gender')=='Female') selected @endif value="Female">Female</option>
                                                    <option @if (old('gender')=='Other') selected @endif value="Other">Other</option>
                                                </select>
                                                <label for="date_of_birth">Gender</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text"
                                                    class="form-control @error('father_name') is-invalid @enderror"
                                                    name="father_name" id="father_name" placeholder="Father’s Name"
                                                    value="{{ old('father_name') }}">
                                                <label for="father_name">Father’s Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text"
                                                    class="form-control @error('mother_name') is-invalid @enderror"
                                                    name="mother_name" id="mother_name" placeholder="Mother’s Name"
                                                    value="{{ old('mother_name') }}">
                                                <label for="mother_name">Mother’s Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <select class="form-select @error('nationality') is-invalid @enderror"
                                                    aria-label="Default select example" name="nationality"
                                                    id="nationality" onchange="checkNationality()">
                                                    <option value="" selected>Select Nationality</option>
                                                    <option @if (old('nationality') == 'Indian') selected @endif value="Indian">Indian</option>
                                                    <option @if (old('nationality') == 'NonIndian') selected @endif value="NonIndian">Non Indian</option>
                                                </select>
                                                <label for="date_of_birth">Gender</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="passport" id="passport"
                                                    placeholder="Passport Number" disabled
                                                    value="{{ old('passport') }}">
                                                <label for="passport">Passport Number</label>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <button type="button" id="button1" class="btn btn-secondary"
                                                disabled>Previous</button>
                                            <button type="button" id="button2" class="btn btn-primary">Next</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade contact-details pt-3" id="contact-details">
                                    <!-- Profile Edit Form -->
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea class="form-control @error('address') is-invalid @enderror"
                                                    placeholder="Address" name="address" id="address"
                                                    style="height: 100px;">{{ old('address') }}</textarea>
                                                <label for="address">Address</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-md-12">
                                                <div class="form-floating">
                                                    <select class="form-select @error('country') is-invalid @enderror"
                                                        name="country" id="country" aria-label="Country">
                                                        <option value="">Select Country</option>
                                                        @foreach($countries as $country)
                                                            <option value="{{ $country->country_name }}">
                                                                {{ $country->country_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="country">Countary</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-select @error('state') is-invalid @enderror"
                                                    name="state" id="state" aria-label="State">
                                                    <option value="" selected>Select State</option>
                                                </select>
                                                <label for="state">State</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-md-12">
                                                <div class="form-floating">
                                                    <select class="form-select @error('city') is-invalid @enderror"
                                                        name="city" id="city" aria-label="City">
                                                        <option value="" selected>Select City</option>
                                                    </select>
                                                    <label for="city">City</label>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" value="{{ $auth_token }}" name="auth_token"
                                            id="auth_token">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="number"
                                                    class="form-control @error('pincode') is-invalid @enderror"
                                                    name="pincode" id="pincode" placeholder="Pincode"
                                                    value="{{ old('pincode') }}" max="999999"
                                                    pattern="/^-?\d+\.?\d*$/"
                                                    onKeyPress="if( this.value.length == 6 ) return false;">
                                                <label for="pincode">Pincode</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" id="email" placeholder="Email ID"
                                                    value="{{ old('email') }}">
                                                <label for="email">Email ID</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="number"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    name="phone" id="phone" placeholder="Phone Nubmer"
                                                    value="{{ old('phone') }}" max="9999999999"
                                                    pattern="/^-?\d+\.?\d*$/"
                                                    onKeyPress="if( this.value.length == 10 ) return false;">
                                                <label for="phone">Phone Nubmer</label>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <button type="button" id="button3" class="btn btn-secondary">Previous</button>
                                            <button type="button" id="button4" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                    <!-- End Profile Edit Form -->
                                </div>

                            </div><!-- End Bordered Tabs -->
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </section>
    @include('admin.layouts.footer')
</main><!-- End #main -->
<!-- End #main -->

@endsection

@section('customJS')
<!-- Custom Javascript To Handle Previous and Next Buttons -->
<script>
    var buttonA = document.getElementById("personal-details-button");
    var buttonB = document.getElementById("contact-details-button");

    var button2 = document.getElementById("button2");
    var button3 = document.getElementById("button3");

    button2.addEventListener("click", function () {
        event.preventDefault();
        if (validatePersonalDetails()) {
            $(buttonB).removeAttr('disabled');
            buttonB.click();
            $(buttonB).prop('disabled', true);
        }
    });
    button3.addEventListener("click", function () {
        event.preventDefault();
        $(buttonA).removeAttr('disabled');
        buttonA.click();
        $(buttonA).prop('disabled', true);
    });
    button4.addEventListener("click", function () {
        event.preventDefault();
        if (validateContactDetails()) {
            document.getElementById("formData").submit();
        }
    });

</script>

<!-- Javascript To Upload Photo -->
<script>
    var a = document.getElementById("blah");
    var photo = document.getElementById("photo");
    function readUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = (e) => {
                a.src = e.target.result;
            };
        }
    }
    function removeImg() {
        a.src = "http://placehold.it/180";
        photo.value = "";
    }
</script>

<script>
    // Javascript To Enable/Disable Passport Field
    function checkNationality() {
        var nationality = $('#nationality').val();
        if (nationality == "Indian") {
            document.getElementById("passport").disabled = true;
        } else {
            document.getElementById("passport").disabled = false;
        }
    }
    // Javascript To Check Duplicate File No
    function checkDuplicate() {
        fileNo = $('#file_number').val();
        $.ajax({
            url: "{{ route('registerPatient.checkDuplicate', '') }}/" + fileNo,
            type: "GET",
            success: function (response) {
                if (response.status) {
                    $('#file_number').addClass("is-invalid");
                    $('#duplicate-file-no').html("File No Already Exists");
                } else {
                    $('#file_number').removeClass("is-invalid");
                    $('#duplicate-file-no').html("");
                }
            }
        });
    }
</script>

<!-- Javascript For Universal API Integration -->
<script>
    $(document).ready(function () {
        $("#country").change(function () {
            var country = $(this).val();
            if (country == "") {
                country = "null";
            }
            var data = {
                auth_token: $("#auth_token").val(),
                country: country
            }
            $.ajax({
                url: "{{ route('getStatesR') }}",
                type: "GET",
                data: data,
                success: function (response) {
                    var states = JSON.parse(response);
                    var html = '<option value="">Select State</option>';
                    if (states.length > 0) {
                        for (let i = 0; i < states.length; i++) {
                            var state = states[i]['state_name'];
                            html += '<option value="' + state + '">' + state + '</option>';
                        }
                    } else {
                        $("#city").html('<option value="">Select City</option>')
                    }
                    $("#state").html(html);
                }
            });
        });

        $("#state").change(function () {
            var state = $(this).val();
            if (state == "") {
                state = "null";
            }
            var data = {
                auth_token: $("#auth_token").val(),
                state: state
            }
            $.ajax({
                url: "{{ route('getCitiesR') }}",
                type: "GET",
                data: data,
                success: function (response) {
                    var cities = JSON.parse(response);
                    var html = '<option value="">Select City</option>';
                    if (cities.length > 0) {
                        for (let i = 0; i < cities.length; i++) {
                            var city = cities[i]['city_name'];
                            html += '<option value="' + city + '">' + city + '</option>';
                        }
                    }
                    $("#city").html(html);
                }
            });
        });
    });

</script>

<script>
    function validatePersonalDetails() {
        $('.is-invalid').removeClass('is-invalid');
        var fileNumber = $('#file_number').val();
        var firstName = $('#first_name').val();
        var dateOfBirth = $('#date_of_birth').val();
        var gender = $('#gender').val();
        var fatherName = $('#father_name').val();
        var nationality = $('#nationality').val();
        var result = true;
        if ((fileNumber == "")) {
            $('#file_number').addClass("is-invalid");
            result = false;
        }
        if ((firstName == "")) {
            $('#first_name').addClass("is-invalid");
            result = false;
        }
        if ((dateOfBirth == "")) {
            $('#date_of_birth').addClass("is-invalid");
            result = false;
        }
        if ((gender == "")) {
            $('#gender').addClass("is-invalid");
            result = false;
        }
        if ((fatherName == "")) {
            $('#father_name').addClass("is-invalid");
            result = false;
        }
        if ((nationality == "")) {
            $('#nationality').addClass("is-invalid");
            result = false;
        }
        return result;
    }

    function validateContactDetails() {
        $('.is-invalid').removeClass('is-invalid');
        var address = $('#address').val();
        var country = $('#country').val();
        var state = $('#state').val();
        var city = $('#city').val();
        var pincode = $('#pincode').val();
        var phone = $('#phone').val();
        var result = true;
        if ((address == "")) {
            $('#address').addClass("is-invalid");
            result = false;
        }
        if ((country == "")) {
            $('#country').addClass("is-invalid");
            result = false;
        }
        if ((state == "")) {
            $('#state').addClass("is-invalid");
            result = false;
        }
        if ((city == "")) {
            $('#city').addClass("is-invalid");
            result = false;
        }
        if ((pincode == "")) {
            $('#pincode').addClass("is-invalid");
            result = false;
        }
        if ((email == "")) {
            $('#email').addClass("is-invalid");
            result = false;
        }
        if ((phone == "")) {
            $('#phone').addClass("is-invalid");
            result = false;
        }
        return result;
    }
</script>
@endsection
