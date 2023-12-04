@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')
<main id="main" class="main leaves-bg">
    <div class="pagetitle d-flex align-items-center justify-content-between">
        <h3 class="text-primary">Modify Patient Details</h3>
    </div>

    <section class="section profile">
        <form method="POST" action="{{ route('patient.update', ['patientId'=>$patient->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="file_number" id="file_number" value="$patient->file_number">
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
                                <li class="nav-item">
                                    <button type="button" id="medical-details-button" class="nav-link"
                                        data-bs-toggle="tab" data-bs-target="#medical-details" disabled>MEDICAL
                                        DETAILS</button>
                                </li>

                                <li class="nav-item">
                                    <button type="button" id="doctor-questions-button" class="nav-link"
                                        data-bs-toggle="tab" data-bs-target="#doctor-questions" disabled>DOCTOR'S
                                        QUESTIONS</button>
                                </li>
                            </ul>

                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active personal-details" id="personal-details">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text"
                                                    class="form-control @error('first_name') is-invalid @enderror"
                                                    name="first_name" id="first_name" placeholder="First Name"
                                                    value="{{ $patient->first_name }}">
                                                <label for="first_name">First Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text"
                                                    class="form-control @error('last_name') is-invalid @enderror"
                                                    name="last_name" id="last_name" placeholder="Last Name"
                                                    value="{{ $patient->last_name }}">
                                                <label for="last_name">Last Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="date"
                                                    class="form-control @error('date_of_birth') is-invalid @enderror"
                                                    name="date_of_birth" id="date_of_birth" placeholder="Date Of Birth"
                                                    value="{{ $patient->date_of_birth }}" max="{{now()->format('Y-m-d')}}">
                                                <label for="date_of_birth">Date Of Birth</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <select class="form-select @error('gender') is-invalid @enderror"
                                                    aria-label="Default select example" name="gender" id="gender">
                                                    <option value="" selected>Select Gender</option>
                                                    <option @if ($patient->gender=='Male') selected @endif value="Male">Male</option>
                                                    <option @if ($patient->gender=='Female') selected @endif value="Female">Female</option>
                                                    <option @if ($patient->gender=='Other') selected @endif value="Other">Other</option>
                                                </select>
                                                <label for="date_of_birth">Gender</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text"
                                                    class="form-control @error('father_name') is-invalid @enderror"
                                                    name="father_name" id="father_name" placeholder="Father’s Name"
                                                    value="{{ $patient->father_name }}">
                                                <label for="father_name">Father’s Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text"
                                                    class="form-control @error('mother_name') is-invalid @enderror"
                                                    name="mother_name" id="mother_name" placeholder="Mother’s Name"
                                                    value="{{ $patient->mother_name }}">
                                                <label for="mother_name">Mother’s Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <select class="form-select @error('nationality') is-invalid @enderror"
                                                    aria-label="Default select example" name="nationality"
                                                    id="nationality" onchange="checkNationality()">
                                                    <option value="" selected>Select Nationality</option>
                                                    <option @if ($patient->nationality == 'Indian') selected @endif value="Indian">Indian</option>
                                                    <option @if ($patient->nationality == 'NonIndian') selected @endif value="NonIndian">Non Indian</option>
                                                </select>
                                                <label for="date_of_birth">Gender</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="passport" id="passport"
                                                    placeholder="Passport Number" disabled
                                                    value="{{ $patient->passport }}">
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
                                                    style="height: 100px;">{{ $patient->contactDetail->address }}</textarea>
                                                <label for="address">Address</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-md-12">
                                                <div class="form-floating">
                                                    <input type="text"
                                                        class="form-control @error('country') is-invalid @enderror"
                                                        name="country" id="country" placeholder="Country"
                                                        value="{{ $patient->ContactDetail->country }}">
                                                    <label for="country">Countary</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text"
                                                    class="form-control @error('state') is-invalid @enderror"
                                                    name="state" id="state" placeholder="State"
                                                    value="{{ $patient->ContactDetail->state }}">
                                                <label for="state">State</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-md-12">
                                                <div class="form-floating">
                                                    <input type="text"
                                                        class="form-control @error('city') is-invalid @enderror"
                                                        name="city" id="city" placeholder="City"
                                                        value="{{ $patient->ContactDetail->city }}">
                                                    <label for="city">City</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="number"
                                                    class="form-control @error('pincode') is-invalid @enderror"
                                                    name="pincode" id="pincode" placeholder="Pincode"
                                                    value="{{ $patient->ContactDetail->pincode }}"
                                                    max="999999" pattern="/^-?\d+\.?\d*$/"
                                                    onKeyPress="if( this.value.length == 6 ) return false;">
                                                <label for="pincode">Pincode</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" id="email" placeholder="Email ID"
                                                    value="{{ $patient->ContactDetail->email }}">
                                                <label for="email">Email ID</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="number"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    name="phone" id="phone" placeholder="Phone Nubmer"
                                                    value="{{ $patient->ContactDetail->phone }}"
                                                    max="9999999999" pattern="/^-?\d+\.?\d*$/"
                                                    onKeyPress="if( this.value.length == 10 ) return false;">
                                                <label for="phone">Phone Nubmer</label>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <button type="button" id="button3"
                                                class="btn btn-secondary">Previous</button>
                                            <button type="button" id="button4" class="btn btn-primary">Next</button>
                                        </div>
                                    </div>
                                    <!-- End Profile Edit Form -->
                                </div>

                                <div class="tab-pane fade pt-3" id="medical-details">
                                    <!-- Settings Form -->
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="number" step="any"
                                                    class="form-control @error('height') is-invalid @enderror"
                                                    name="height" id="height" placeholder="Height"
                                                    value="{{ $patient->MedicalDetail ? $patient->MedicalDetail->height : ''}}">
                                                <label for="height">Height</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="number" step="any"
                                                    class="form-control @error('weight') is-invalid @enderror"
                                                    name="weight" id="weight" placeholder="Weight"
                                                    value="{{ $patient->MedicalDetail ? $patient->MedicalDetail->weight : ''}}">
                                                <label for="weight">Weight</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating @error('blood_group') is-invalid @enderror">
                                                <select class="form-select" aria-label="Blood Group" name="blood_group"
                                                    id="blood_group">
                                                    <option value="">Blood Group</option>
                                                    <option @if ( $patient->MedicalDetail ? $patient->MedicalDetail->blood_group=='A+' : '') selected @endif value="A+">A+</option>
                                                    <option @if ( $patient->MedicalDetail ? $patient->MedicalDetail->blood_group=='A-' : '') selected @endif value="A-">A-</option>
                                                    <option @if ( $patient->MedicalDetail ? $patient->MedicalDetail->blood_group=='B+' : '') selected @endif value="B+">B+</option>
                                                    <option @if ( $patient->MedicalDetail ? $patient->MedicalDetail->blood_group=='B-' : '') selected @endif value="B-">B-</option>
                                                    <option @if ( $patient->MedicalDetail ? $patient->MedicalDetail->blood_group=='AB+' : '') selected @endif value="AB+">AB+</option>
                                                    <option @if ( $patient->MedicalDetail ? $patient->MedicalDetail->blood_group=='AB-' : '') selected @endif value="AB-">AB-</option>
                                                    <option @if ( $patient->MedicalDetail ? $patient->MedicalDetail->blood_group=='O+' : '') selected @endif value="O+">O+</option>
                                                    <option @if ( $patient->MedicalDetail ? $patient->MedicalDetail->blood_group=='O-' : '') selected @endif value="O-">O-</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text"
                                                    class="form-control @error('blood_pressure') is-invalid @enderror"
                                                    name="blood_pressure" id="blood_pressure"
                                                    placeholder="Blood Pressure"
                                                    value="{{ $patient->MedicalDetail ? $patient->MedicalDetail->blood_pressure : ''}}">
                                                <label for="blood_pressure">Blood Pressure</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <textarea
                                                    class="form-control @error('present_disease') is-invalid @enderror"
                                                    placeholder="Present Disease" name="present_disease"
                                                    id="present_disease"
                                                    style="height: 50px;">{{ $patient->MedicalDetail ? $patient->MedicalDetail->present_disease : ''}}</textarea>
                                                <label for="present_disease">Present Disease</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <textarea
                                                    class="form-control @error('past_history') is-invalid @enderror"
                                                    placeholder="Past History" name="past_history" id="past_history"
                                                    style="height: 50px;">{{ $patient->MedicalDetail ? $patient->MedicalDetail->past_history : ''}}</textarea>
                                                <label for="past_history">Past History</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <textarea
                                                    class="form-control @error('family_history') is-invalid @enderror"
                                                    placeholder="Family History" name="family_history"
                                                    id="family_history"
                                                    style="height: 50px;">{{ $patient->MedicalDetail ? $patient->MedicalDetail->family_history : ''}}</textarea>
                                                <label for="family_history">Family History</label>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <button type="button" id="button5"
                                                class="btn btn-secondary">Previous</button>
                                            <button type="button" id="button6" class="btn btn-primary">Next</button>
                                        </div>
                                    </div>
                                    <!-- End settings Form -->
                                </div>

                                <div class="tab-pane fade pt-3" id="doctor-questions">
                                    <!-- Change Password Form -->
                                    <div class="row g-3">
                                        @if ($patient->DoctorQuestion->isNotEmpty())
                                            @foreach($patient->DoctorQuestion as $doctorQuestion)
                                                <div class="col-12">
                                                    <label for="Question"
                                                        class="form-label">{{ $doctorQuestion->QuestionMaster->question }}</label>
                                                    <textarea class="form-control" placeholder="Your Answer" name="answer[]"
                                                        style="height: 50px;">{{ $doctorQuestion->answer }}</textarea>
                                                    <input type="hidden" name="question_id[]" value="{{ $doctorQuestion->id }}">
                                                </div>
                                            @endforeach
                                        @else
                                            @foreach($questions as $doctorQuestion)
                                                <div class="col-12">
                                                    <label for="Question"
                                                        class="form-label">{{ $doctorQuestion->question }}</label>
                                                    <textarea class="form-control" placeholder="Your Answer" name="answer[]"
                                                        style="height: 50px;"></textarea>
                                                    <input type="hidden" name="question_id[]" value="{{ $doctorQuestion->id }}">
                                                </div>
                                            @endforeach 
                                        @endif
                                        <div class="d-flex justify-content-between">
                                            <button type="button" id="button7"
                                                class="btn btn-secondary">Previous</button>
                                            <button type="submit" id="button8" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                    <!-- End Change Password Form -->
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
    var buttonC = document.getElementById("medical-details-button");
    var buttonD = document.getElementById("doctor-questions-button");

    var button2 = document.getElementById("button2");
    var button3 = document.getElementById("button3");
    var button4 = document.getElementById("button4");
    var button5 = document.getElementById("button5");
    var button6 = document.getElementById("button6");
    var button7 = document.getElementById("button7");

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
            $(buttonC).removeAttr('disabled');
            buttonC.click();
            $(buttonC).prop('disabled', true);
        }
    });
    button5.addEventListener("click", function () {
        event.preventDefault();
        $(buttonB).removeAttr('disabled');
        buttonB.click();
        $(buttonB).prop('disabled', true);
    });
    button6.addEventListener("click", function () {
        event.preventDefault();
        if (validateMedicalDetails()) {
            $(buttonD).removeAttr('disabled');
            buttonD.click();
            $(buttonD).prop('disabled', true);
        }
    });
    button7.addEventListener("click", function () {
        event.preventDefault();
        $(buttonC).removeAttr('disabled');
        buttonC.click();
        $(buttonC).prop('disabled', true);
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

</script>

<script>
    function validatePersonalDetails() {
        $('.is-invalid').removeClass('is-invalid');
        var fileNumber = $('#file_number').val();
        var firstName = $('#first_name').val();
        // var lastName = $('#last_name').val();
        // var dateOfBirth = $('#date_of_birth').val();
        var gender = $('#gender').val();
        // var fatherName = $('#father_name').val();
        // var motherName = $('#mother_name').val();
        var nationality = $('#nationality').val();
        // var passport = $('#passport').val();
        var result = true;
        if ((fileNumber == "")) {
            $('#file_number').addClass("is-invalid");
            result = false;
        }
        if ((firstName == "")) {
            $('#first_name').addClass("is-invalid");
            result = false;
        }
        // if ((lastName == "")) {
        //     $('#last_name').addClass("is-invalid");
        //     result = false;
        // }
        // if ((dateOfBirth == "")) {
        //     $('#date_of_birth').addClass("is-invalid");
        //     result = false;
        // }
        if ((gender == "")) {
            $('#gender').addClass("is-invalid");
            result = false;
        }
        // if ((fatherName == "")) {
        //     $('#father_name').addClass("is-invalid");
        //     result = false;
        // }
        // if ((motherName == "")) {
        //     $('#mother_name').addClass("is-invalid");
        //     result = false;
        // }
        if ((nationality == "")) {
            $('#nationality').addClass("is-invalid");
            result = false;
        }
        // if ((nationality == "Non Indian")) {
        //     if (passport == "") {
        //         $('#passport').addClass("is-invalid");
        //         result = false;
        //     }
        // }
        return result;
    }

    function validateContactDetails() {
        $('.is-invalid').removeClass('is-invalid');
        // var address = $('#address').val();
        // var country = $('#country').val();
        // var state = $('#state').val();
        // var city = $('#city').val();
        // var pincode = $('#pincode').val();
        // var email = $('#email').val();
        var phone = $('#phone').val();
        var result = true;
        // if ((address == "")) {
        //     $('#address').addClass("is-invalid");
        //     result = false;
        // }
        // if ((country == "")) {
        //     $('#country').addClass("is-invalid");
        //     result = false;
        // }
        // if ((state == "")) {
        //     $('#state').addClass("is-invalid");
        //     result = false;
        // }
        // if ((city == "")) {
        //     $('#city').addClass("is-invalid");
        //     result = false;
        // }
        // if ((pincode == "")) {
        //     $('#pincode').addClass("is-invalid");
        //     result = false;
        // }
        // if ((email == "")) {
        //     $('#email').addClass("is-invalid");
        //     result = false;
        // }
        if ((phone == "")) {
            $('#phone').addClass("is-invalid");
            result = false;
        }
        return result;
    }

    function validateMedicalDetails() {
        $('.is-invalid').removeClass('is-invalid');
        // var height = $('#height').val();
        // var weight = $('#weight').val();
        // var blood_group = $('#blood_group').val();
        // var blood_pressure = $('#blood_pressure').val();
        var present_disease = $('#present_disease').val();
        // var past_history = $('#past_history').val();
        // var family_history = $('#family_history').val();
        var result = true;
        // if ((height == "")) {
        //     $('#height').addClass("is-invalid");
        //     result = false;
        // }
        // if ((weight == "")) {
        //     $('#weight').addClass("is-invalid");
        //     result = false;
        // }
        // if ((blood_group == "")) {
        //     $('#blood_group').addClass("is-invalid");
        //     result = false;
        // }
        // if ((blood_pressure == "")) {
        //     $('#blood_pressure').addClass("is-invalid");
        //     result = false;
        // }
        if ((present_disease == "")) {
            $('#present_disease').addClass("is-invalid");
            result = false;
        }
        // if ((past_history == "")) {
        //     $('#past_history').addClass("is-invalid");
        //     result = false;
        // }
        // if ((family_history == "")) {
        //     $('#family_history').addClass("is-invalid");
        //     result = false;
        // }
        return result;
    }

</script>
@endsection
